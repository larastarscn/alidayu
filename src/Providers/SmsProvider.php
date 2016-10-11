<?php
namespace Larastarscn\AliDaYu\Providers;

use Larastarscn\AliDaYu\Traits\ParamChecker;

class SmsProvider extends AbstractProvider
{
    use ParamChecker;

    /**
     * Get response from the send API .
     *
     * @param  array  $params
     * @return Psr\Http\Message\ResponseInterface
     */
    public function send($params)
    {
        $this->checkParams($params);
        $this->setMethod('sms.send');

        return $this->getResponse($params);
    }

    /**
     * Get response from the query API .
     *
     * @param  array  $params
     * @return Psr\Http\Message\ResponseInterface
     */
    public function query($params)
    {
        $params = array_merge(['current_page' => 1, 'page_size' => 20], $params);

        if ($params['page_size'] > 50) {
            $params['page_size'] = 50;
        }

        $this->checkParams($params, 'sms.query');
        $this->setMethod('sms.query');

        return $this->getResponse($params);
    }

}
