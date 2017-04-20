Yii2-liqpay
==========
В составе модуля содержится виджет оплаты заказа через liqpay.com.

В виджет передается модель заказа, которая должна имплементировать интерфейс interfaces/Order.

Модуль написан в основном для [pistol88/yii2-order](https://github.com/pistol88/yii2-order), но подойдет для любого сайта, где есть модель заказа.

Установка
---------------------------------
Выполнить команду

```
php composer require pistol88/yii2-liqpay "*"
```

Или добавить в composer.json

```
"pistol88/yii2-liqpay": "*",
```

И выполнить

```
php composer update
```

Подключение и настройка
---------------------------------
В конфигурационный файл приложения добавить модуль liqpay

```php
    'modules' => [
        'liqpay' => [
            'class' => 'pistol88\liqpay\Module',
            'public_key' => 'iNNNNNNNNNNN',
            'private_key' => 'NzpRclCywaSOrm0LTpqDpPPlRDhoOQyIX1ISHjk',
            'currency' => 'UAH',
            'pay_way' => null,
            'version' => 3,
            'sandbox' => false,
            'language' => 'ru',
            'result_url' => '/page/thanks',
            'paymentName' => 'Оплата заказа',
            'orderModel' => 'pistol88\order\models\Order', //Модель заказа. Эта модель должна имплементировать интерфейс pistol88\liqpay\interfaces\Order. В момент списания денег будет вызываться $model->setPaymentStatus('yes').
        ],
        //...
    ],
```

Виджеты
---------------------------------
За вывод формы оплаты отвечает виджет pistol88\liqpay\widgets\PaymentForm.

Скорее всего, самое уместное место для виджета - страница "спасибо за заказ.

```php
<?=\pistol88\liqpay\widgets\PaymentForm::widget([
    'autoSend' => true,
    'orderModel' => $model,
    'description' => 'Оплата заказа'
]);?>
```

* autoSend - нужно ли автоматически отправлять форму заказа
* orderModel - экземпляр модели заказа, имплементирующий interfaces/Order
* description - описание платежа
