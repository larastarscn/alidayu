<?php
namespace Larastarscn\AliDaYu;

use Larastarscn\AliDaYu\Contracts\Factory;
use Larastarscn\AliDaYu\Providers\SmsProvider;
use Larastarscn\AliDaYu\Providers\TTSProvider;
use Larastarscn\AliDaYu\Providers\FlowProvider;
use Larastarscn\AliDaYu\Providers\VoiceProvider;
use Larastarscn\AliDaYu\Exceptions\UnknowDriverException;

class AliDaYuManager implements Factory
{
    /**
     * The config of the service.
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
     * Create a new manager instance.
     *
     * @param  array  $config
     * @param  \GuzzleHttp\Client  $httpClient
     * @return void
     */
    public function __construct($config, $httpClient)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
    }

    /**
     * Creata a new provider implementation.
     *
     * @param  string  $driver
     * @return \Larastarscn\AliDaYu\Providers\AbstractProvider
     */
    public function driver($driver)
    {
        switch ($driver) {
            case 'sms':
                return new SmsProvider($this->config, $this->httpClient);
                break;
            case 'tts':
                return new TTSProvider($this->config, $this->httpClient);
                break;
            case 'voice':
                return new VoiceProvider($this->config, $this->httpClient);
                break;
            case 'flow':
                return new FlowProvider($this->config, $this->httpClient);
                break;
            default:
                throw new UnknowDriverException("The name of driver is not found.");
                break;
        }
    }
}
