<?php


namespace Model;


class Cart {

    private $cart = array();
    private $tax = 0.0;
    private $cost = 0.0;
    private $shipping = 0.0;

    public function getCart() { return $this->cart; }

    public function setCart($cart) { $this->cart = $cart; }

    public function getTax() { return $this->tax; }

    public function setTax($tax) { $this->tax = $tax; }

    public function getCost() { return $this->cost; }

    public function setCost($cost) { $this->cost = $cost; }

    public function getShipping() { return $this->shipping; }

    public function setShipping($shipping) { $this->shipping = $shipping; }
}