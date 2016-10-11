<?php
namespace Larastarscn\AliDaYu\Providers;

use Larastarscn\AliDaYu\Traits\ParamChecker;

class FlowProvider extends AbstractProvider
{
    use ParamChecker;

    /**
     * Get response from the query API .
     *
     * @param  array  $params
     * @return Psr\Http\Message\ResponseInterface
     */
    public function query($params = [])
    {
        $this->setMethod('flow.query');

        return $this->getResponse($params);
    }

    /**
     * Get response from the charge API .
     *
     * @param  array  $params
     * @return Psr\Http\Message\ResponseInterface
     */
    public function charge($params)
    {
        $this->checkParams($params, 'flow.charge');
        $this->setMethod('flow.charge');

        return $this->getResponse($params);
    }

    /**
     * Get response from the grade API .
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public function grade()
    {
        $this->setMethod('flow.grade');

        return $this->getResponse([]);
    }

    /**
     * Get response from the charge province API .
     *
     * @param  array  $params
     * @return Psr\Http\Message\ResponseInterface
     */
    public function chargeProvince($params)
    {
        $this->checkParams($params, 'flow.charge.province');
        $this->setMethod('flow.charge.province');

        return $this->getResponse($params);
    }
}
