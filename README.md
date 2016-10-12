
# Larastarscn AliDaYu

[![License](https://poser.pugx.org/larastarscn/alidayu/license.svg)](https://packagist.org/packages/larastarscn/alidayu)

## Introduction

This package provides a simple and convenient interface to AliDaYu. It make you request any interface of AliDaYu in just a minute.

## Installion

To get started with AliDaYu, add to your `composer.json` file as a dependency:

    composer require larastarscn/alidayu

Then type the `composer install` command to the cli.

## Configure

After installing the AliDaYu libary, register the `Larastarscn\AliDaYu\AliDaYuServiceProvider` in your `config/app.php` configuration file:

    'providers' => [
        // Other service providers...

        Larastarscn\AliDaYu\AliDaYuServiceProvider::class,
    ]

Also, add the `AliDaYu` facades to the `aliases` array in your `app.php` configuration file:

    'AliDaYu' => Larastarscn\AliDaYu\Facades\AliDaYu::class

Then, you will need to publish the `alidayu.php` configuration file to the `config` directory:

    php artisan vendor:publish

Also, you will need register the application infomation within `config/alidayu.php`.

## Usage

Now you can request any interface by AliDaYu facades, to send an sms, you may code like this:

    <?php
    namespace App\Http\Controllers;

    use AliDaYu;

    class AliDaYuController extends Controller
    {
        public function sendSms()
        {
            $response = AliDaYu::driver('sms')->send([
                'extend' => 'wang',
                'sms_type' => 'normal',
                'sms_free_sign_name' => 'test',
                'sms_param' => '{"code": "3052", "name": "Dearmadman"}',
                'rec_num' => '18949825252',
                'sms_template_code' => 'SMS_16691757'
            ]);

            dd($response->getBody()->getContents());
        }
    }


Next, we will list the rest of interface in fllow:

**alibaba.aliqin.fc.sms.num.query**

    $response = AliDaYu::driver('sms')->query([
        'rec_num' => 18949825252,
        'query_date' => '20161011',
        'current_page' => 1,
        'page_size' => 10,
    ]);

**alibaba.aliqin.fc.tts.num.singlecall**

    $response = AliDaYU::driver('tts')->singleCall([
        'extend' => 'wang',
        'tts_param' => '{"name": "wang", "code": "Dearmadman"}',
        'called_num' => 18949825252,
        'called_show_num' => '051482043271',
        'tts_code' => 'TTS_16825713'
    ]);

**alibaba.aliqin.fc.voice.num.singlecall**

    $response = AliDaYu::driver('voice')->singleCall([
        'extend' => 'wang',
        'called_num' => 18949825252,
        'called_show_num' => '051482043271',
        'voice_code' => '2fc5d547-71c0-45e6-8b06-1f3dc40b630c.wav',
    ]);

**alibaba.aliqin.fc.voice.num.doublecall**

    $response = AliDaYu::driver('voice')->doubleCall([
        'extend' => 'Dearmadman',
        'caller_num' => 18949825252,
        'caller_show_num' => '51482043271',
        'called_num' => 18949825250,
        'called_show_num' => '51482043271',
    ]);

**alibaba.aliqin.fc.flow.query**

    $response = AliDaYu::driver('flow')->query([
        'out_id' => 'out_id'  // options
    ]);

**alibaba.aliqin.fc.flow.charge**

    $response = AliDaYu::driver('flow')->charge([
        'phone_num' => 18949825252,
        'reason' => 'no reason',
        'grade' => '50',
        'out_recharge_id' => '6d9fce1e',
    ]);

**alibaba.aliqin.fc.flow.grade**

    $response = AliDaYu::driver('flow')->grade();

**alibaba.aliqin.fc.flow.charge.province**

    $response = AliDaYu::driver('flow')->chargeProvince([
        'phone_num' => 18949825252,
        'reason' => 'no reason',
        'grade' => '50',
        'out_recharge_id' => '6d9fce1e',
    ]);


Simple like this and easy to use. :)