<?php
namespace Larastarscn\AliDaYu\Providers;

use Larastarscn\AliDaYu\Traits\MethodSetter;

class AbstractProvider
{
    use MethodSetter;

    protected $method;
    protected $appKey;
    protected $appSecret;
    protected $format = 'json';
    protected $version = '2.0';
    protected $partnerId;
    protected $targetAppKey;
    protected $simplify = false;
    protected $signMethod = 'md5';
    protected $env = "production";
    protected $https = false;

    protected $config;
    protected $httpClient;


    public function __construct($config, $httpClient)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
        $this->appKey = $config['app_key'];
        $this->appSecret = $config['app_secret'];
        $this->env = $config['env'];
    }

    public function buildPublicParams()
    {
        return [
            'method' => $this->method,
            'app_key' => $this->appKey,
            'timestamp' => $this->getTimestamp(),
            'format' => $this->format,
            'v' => $this->version,
            'sign_method' => $this->signMethod,
        ];
    }

    public function getQueryBody($params)
    {
        $params = array_merge($this->buildPublicParams(), $params);
        $sign = $this->sign($params);

        return array_merge($params, compact('sign'));
    }

    public function sign($params)
    {
        ksort($params);
        $str = '';
        foreach ($params as $key => $value) {
            $str .=$key.$value;
        }

        if ($this->signMethod === 'hmac') {
            return strtoupper(hash_hmac('md5', $str, $this->appSecret));
        }

        return strtoupper(md5($this->appSecret. $str . $this->appSecret));
    }

    public function getTimestamp()
    {
        $timezone = date_default_timezone_get();

        if ($timezone != $this->config['timezone']) {
            date_default_timezone_set($this->config['timezone']);
            $date = date('Y-m-d H:i:s');
            date_default_timezone_set($timezone);
        } else {
            $date = date('Y-m-d H:i:s');
        }

        return $date;
    }

    public function getRequestURL()
    {
        $https = $this->https ? 'https' : 'http';

        $urls = [
            'production' => [
                'http' => 'http://gw.api.taobao.com/router/rest',
                'https' => 'https://eco.taobao.com/router/rest',
            ],
            'sandbox' => [
                'http' => 'http://gw.api.tbsandbox.com/router/rest',
                'https' => 'https://gw.api.tbsandbox.com/router/rest',
            ],
        ];

        return $urls[$this->env][$https];
    }

    public function configure($options)
    {
        foreach ($options as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    public function getResponse($params)
    {
        $response = $this->httpClient->get($this->getRequestURL(), [
            'query' => $this->getQueryBody($params),
        ]);

        return $response;
    }
}
