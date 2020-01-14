<?php


namespace Model;


class Cart {

    private $cart = array();
    private $tax = 0.0;
    private $cost = 0.0;
    private $shipping = 0.0;

    public function addToCart($name, $product, $qty) {
        // Check if already in cart
        if(isset($this->cart[$name])) {
            $this->cart[$name]["qty"] += $qty;
        }else {
            // Not in cart so add it
            array_push($this->cart, [$name => ["product" => $product, "qty" => $qty]]);
        }
    }

    public function getCart() { return $this->cart; }

    public function setCart($cart) { $this->cart = $cart; }

    public function getTax() { return $this->tax; }

    public function setTax($tax) { $this->tax = $tax; }

    public function getCost() { return $this->cost; }

    public function setCost($cost) { $this->cost = $cost; }

    public function getShipping() { return $this->shipping; }

    public function setShipping($shipping) { $this->shipping = $shipping; }
}