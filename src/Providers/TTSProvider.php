<?php
namespace Larastarscn\AliDaYu\Providers;

use Larastarscn\AliDaYu\Providers\AbstractProvider;
use Larastarscn\AliDaYu\Traits\ParamChecker;

class TTSProvider extends AbstractProvider
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
        $this->checkParams($params, 'tts.singlecall');
        $this->setMethod('tts.singlecall');

        return $this->getResponse($params);
    }
}
