<?php
namespace pistol88\liqpay\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class LiqpayController extends Controller
{
    public function beforeAction($action)
    {            
        if ($action->id == 'payment') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
    
    public function actions()
    {
        return [
            'result' => [
                'class' => 'voskobovich\liqpay\actions\CallbackAction',
                'callable' => 'payment',
            ]
        ];
    }
    
    function actionPayment($model)
    {
        $orderModel = $this->module->orderModel;
        $orderModel = $orderModel::findOne($model->order_id);

        if(!$orderModel) {
            throw new NotFoundHttpException('The requested order does not exist.');
        }

        $orderModel->setPaymentStatus('yes');
        $orderModel->save(false);

        return 'YES';
    }
}
