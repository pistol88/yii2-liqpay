<?php
namespace pistol88\liqpay\interfaces;

interface Order
{
    public function getId();

    public function getCost();

    public function setPaymentStatus($status);
}
