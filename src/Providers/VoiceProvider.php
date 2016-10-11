<?php
namespace Larastarscn\AliDaYu\Providers;

use Larastarscn\AliDaYu\Providers\AbstractProvider;
use Larastarscn\AliDaYu\Traits\ParamChecker;

class VoiceProvider extends AbstractProvider
{
    use ParamChecker;

    /**
     * Get response from the single call API .
     *
     * @param  array  $params
     * @return Psr\Http\Message\ResponseInterface
     */
    public function singleCall($params)
    {
        $this->checkParams($params, 'voice.singlecall');
        $this->setMethod('voice.singlecall');

        return $this->getResponse($params);
    }

    /**
     * Get response from the double call API .
     *
     * @param  array  $params
     * @return Psr\Http\Message\ResponseInterface
     */
    public function doubleCall($params)
    {
        $this->checkParams($params, 'voice.doublecall');
        $this->setMethod('voice.doublecall');

        return $this->getResponse($params);
    }
}
