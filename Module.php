<?php
namespace pistol88\liqpay;

use yii;
use yii\helpers\Url;

class Module extends \yii\base\Module
{
    public $public_key;
    public $private_key;
    public $version = 3;
    public $debug = false;
    public $sandbox = false;
    public $language = 'ru';
    public $server_url;
    public $result_url;
    public $paymentName;
    public $currency;
    public $pay_way;
    public $orderModel = 'pistol88\order\models\Order';
    
    public $thanksUrl = '/page/spasibo-za-zakaz';
    public $failUrl = '/page/problema-s-oplatoy';

    public function init()
    {
        if(empty($this->server_url)) {
            $this->server_url = Url::toRoute(['/liqpay/liqpay/result'], true);
        }

        $app = yii::$app;

        $app->set('liqpay', [
            'class' => '\voskobovich\liqpay\LiqPay',
            'public_key' => $this->public_key,
            'private_key' => $this->private_key,
            'version' => $this->version,
            'debug' => $this->debug,
            'sandbox' => $this->sandbox,
            'language' => $this->language,
            'server_url' => $this->server_url,
            'result_url' => $this->result_url,
            'paymentName' => $this->paymentName,
        ]);

        return parent::init();
    }
}
