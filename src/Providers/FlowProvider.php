<?php
namespace Larastarscn\AliDaYu\Providers;

use Larastarscn\AliDaYu\Traits\ParamChecker;

class FlowProvider extends AbstractProvider
{
    use ParamChecker;

    public function query($params = [])
    {
        $this->setMethod('flow.query');

        return $this->getResponse($params);
    }

    public function charge($params)
    {
        $this->checkParams($params, 'flow.charge');
        $this->setMethod('flow.charge');

        return $this->getResponse($params);
    }

    public function grade()
    {
        $this->setMethod('flow.grade');

        return $this->getResponse([]);
    }

    public function chargeProvince($params)
    {
        $this->checkParams($params, 'flow.charge.province');
        $this->setMethod('flow.charge.province');

        return $this->getResponse($params);
    }
}
