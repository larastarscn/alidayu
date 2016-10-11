<?php
namespace Larastarscn\AliDaYu\Providers;

use Larastarscn\AliDaYu\Traits\ParamChecker;

class SmsProvider extends AbstractProvider
{
    use ParamChecker;

    public function send($params)
    {
        $this->checkParams($params);
        $this->setMethod('sms.send');

        return $this->getResponse($params);
    }

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
