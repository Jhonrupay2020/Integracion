<?php
// features/bootstrap/Basket.php

final class Basket implements \Countable
{
    private $shelf;
    private $services;
    private $servicesPrice = 0.0;

    public function __construct(Shelf $shelf)
    {
        $this->shelf = $shelf;
    }

    public function addProduct($service)
    {
        $this->services[] = $service;
        $this->servicesPrice += $this->shelf->getProductPrice($service);
    }

    public function getTotalPrice()
    {
        return $this->servicesPrice
            + ($this->servicesPrice * 0.18)
            - ($this->servicesPrice > 100 ? 5.0 : 10.0);
    }

    public function count()
    {
        return count($this->services);
    }
}
?>