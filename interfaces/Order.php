<?php
namespace pistol88\order\interfaces;

interface Order
{
    public function getId();

    public function getCost();

    public function setPaymentStatus($status);
}
