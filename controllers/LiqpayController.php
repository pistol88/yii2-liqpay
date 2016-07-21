<?php
namespace pistol88\liqpay\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class LiqpayController extends Controller
{
    public function beforeAction($action)
    {            
        if ($action->id == 'my-method') {
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
        $orderModel = yii::$app->orderModel;
        $orderModel = $orderModel::findOne($model->order_id);

        if(!$orderModel) {
            throw new NotFoundHttpException('The requested order does not exist.');
        }

        $orderModel->setPaymentStatus('yes');
        $orderModel->save(false);

        return 'YES';
    }
}