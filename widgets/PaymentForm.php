<?php

namespace pistol88\liqpay\widgets;

use Yii;
use yii\base\InvalidParamException;
use yii\base\Widget;
use yii\helpers\Url;
use voskobovich\liqpay\widgets\PaymentWidget;

class PaymentForm extends Widget
{
    public $autoSend = true;
    public $autoSendTimeout = 0;
    public $orderModel = null;
    public $description = 'Оплата заказа';
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $module = yii::$app->getModule('liqpay');

        $data = [
            'amount' => $this->orderModel->getCost(),
            'currency' => $module->currency,
            'description' => $this->description,
            'order_id' => (string)$this->orderModel->getId(),
            'recurringbytoken' => false,
            'type' => '',
            'subscribe' => false,
            'subscribe_date_start' => null,
            'subscribe_periodicity' => null,
            'product_url' => null,
            'pay_way' => $module->pay_way,
            Yii::$app->request->csrfParam => Yii::$app->request->csrfToken,
        ];
        
        yii::$app->liqpay->result_url = Url::toRoute([yii::$app->liqpay->result_url, 'id' => $this->orderModel->getId(), 'cash' => true]);
        
        return PaymentWidget::widget(['autoSubmit' => $this->autoSend, 'data' => $data]);
    }
}