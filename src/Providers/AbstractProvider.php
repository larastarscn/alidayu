<?php
namespace Larastarscn\AliDaYu\Providers;

use Larastarscn\AliDaYu\Traits\MethodSetter;

class AbstractProvider
{
    use MethodSetter;

    /**
     * The name for the API.
     *
     * @var string
     */
    protected $method;

    /**
     * The app key of the application.
     *
     * @var string
     */
    protected $appKey;

    /**
     * The app secret of the application.
     *
     * @var string
     */
    protected $appSecret;

    /**
     * The format of the response's content.
     *
     * @var string 'xml'|'json'
     */
    protected $format = 'json';

    /**
     * The version of the API.
     *
     * @var string
     */
    protected $version = '2.0';

    /**
     * The unique identifier of the partner.
     *
     * @var string
     */
    protected $partnerId;

    /**
     * The target app key of the applicaton.
     *
     * @var string
     */
    protected $targetAppKey;

    /**
     * The sign method of the request.
     *
     * @var string
     */
    protected $signMethod = 'md5';

    /**
     * The environment of the request.
     *
     * @var string
     */
    protected $env = "production";

    /**
     * Determine the request's protocol.
     *
     * @var string
     */
    protected $https = false;

    /**
     * The cofing of the service.
     *
     * @var array
     */
    protected $config;

    /**
     * The HTTP client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Create a new provider instance.
     *
     * @param  array  $config
     * @param  \GuzzleHttp\Client  $httpClient
     * @return void
     */
    public function __construct($config, $httpClient)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
        $this->appKey = $config['app_key'];
        $this->appSecret = $config['app_secret'];
        $this->env = $config['env'];
    }

    /**
     * Build public parameters for the request.
     *
     * @return array
     */
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

    /**
     * Concat the all parameters for the request.
     *
     * @param  array  $params
     * @return array
     */
    public function getQueryBody($params)
    {
        $params = array_merge($this->buildPublicParams(), $params);
        $sign = $this->sign($params);

        return array_merge($params, compact('sign'));
    }

    /**
     * Generate the signature.
     *
     * @param  array  $params
     * @return string
     */
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

    /**
     * Obtain the timestamp.
     *
     * @return string
     */
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

    /**
     * Obtain the target of the request.
     *
     * @return string
     */
    public function getRequestURL()
    {
        $protocol = $this->https ? 'https' : 'http';

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

        return $urls[$this->env][$protocol];
    }

    /**
     * Configure the options of the implementation.
     *
     * @param  array  $options
     * @return \Larastarscn\AliDaYu\Providers\AbstractProvider
     */
    public function configure($options)
    {
        foreach ($options as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * Get the response of the request.
     *
     * @param  array  $params
     * @return Psr\Http\Message\ResponseInterface
     */
    public function getResponse($params)
    {
        $response = $this->httpClient->get($this->getRequestURL(), [
            'query' => $this->getQueryBody($params),
        ]);

        return $response;
    }
}
