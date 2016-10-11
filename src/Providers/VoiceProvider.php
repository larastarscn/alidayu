<?php
namespace Larastarscn\AliDaYu\Providers;

use Larastarscn\AliDaYu\Providers\AbstractProvider;
use Larastarscn\AliDaYu\Traits\ParamChecker;

class VoiceProvider extends AbstractProvider
{
    use ParamChecker;

    public function singleCall($params)
    {
        $this->checkParams($params, 'voice.singlecall');
        $this->setMethod('voice.singlecall');

        return $this->getResponse($params);
    }

    public function doubleCall($params)
    {
        $this->checkParams($params, 'voice.doublecall');
        $this->setMethod('voice.doublecall');

        return $this->getResponse($params);
    }
}
