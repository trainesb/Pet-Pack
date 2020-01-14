<?php


namespace Model;


class Cart {

    private $cart = array();
    private $tax = 0.0;
    private $cost = 0.0;
    private $shipping = 0.0;

    public function addToCart($name, $product, $qty) {
        $price = $product->getRegularPrice();

        // Check if already in cart
        $i = 0;
        foreach ($this->cart as $item) {
            if($item["name"] === $name) {
                if($this->cart[$i]["qty"] < $qty) {
                    $this->cart[$i]["qty"] = $qty;
                    $this->cost += $price;
                } else {
                    $this->cart[$i]["qty"] = $qty;
                    $this->cost -= $price;
                }
                return;
            }
            $i += 1;
        }

        $cost = $price * $qty;
        $this->cost += $cost;

        // Not in cart so add it
        array_push($this->cart, ["name" => $name, "product" => $product, "qty" => $qty]);
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