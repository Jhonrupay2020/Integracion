<?php

final class Shelf
{
    private $priceMap = array();

    public function setProductPrice($service, $price)
    {
        $this->priceMap[$service] = $price;
    }

    public function getProductPrice($service)
    {
        return $this->priceMap[$service];
    }
}
?>