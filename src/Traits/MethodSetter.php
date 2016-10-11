<?php
namespace Larastarscn\AliDaYu\Traits;

trait MethodSetter
{
    /**
     * Set method for request.
     *
     * @param  string  $path
     * @return void
     */
    public function setMethod($path)
    {
        $methods = [
            'sms.send' => 'alibaba.aliqin.fc.sms.num.send',
            'sms.query' => 'alibaba.aliqin.fc.sms.num.query',
            'voice.singlecall' => 'alibaba.aliqin.fc.voice.num.singlecall',
            'voice.doublecall' => 'alibaba.aliqin.fc.voice.num.doublecall',
            'tts.singlecall' => 'alibaba.aliqin.fc.tts.num.singlecall',
            'flow.query' => 'alibaba.aliqin.fc.flow.query',
            'flow.charge' => 'alibaba.aliqin.fc.flow.charge',
            'flow.grade' => 'alibaba.aliqin.fc.flow.grade',
            'flow.charge.province' => 'alibaba.aliqin.fc.flow.charge.province',
        ];

        if (! array_key_exists($path, $methods)) {
            throw new \Exception("The ${path} of methods is not found.");
        }

        $this->method = $methods[$path];
    }
}
