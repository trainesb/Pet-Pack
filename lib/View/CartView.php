<?php


namespace View;


class CartView extends View {

    private $cart;

    public function __construct($site, $user, &$session) {
        parent::__construct($site, $user);
        $this->setTitle("Cart");

        $this->cart = $session['cart'];
    }

    public function present() {
        echo $this->head();

        echo '<div id="cart">';
        echo $this->nav();
        echo $this->cart();
        echo '</div>';
        echo $this->footer();
    }

    public function cart() {
        $tax = $this->cart->getTax();
        $cost = $this->cart->getCost();
        $shipping = $this->cart->getShipping();

        $html = <<<HTML
<div class="cart-wrapper">
    <h1>Cart</h1>
    <hr>
    <div class="cart-items">
        <ul class="cart">
HTML;
        foreach ($this->cart->getCart() as $item) {
            $name = $item['name'];
            $product = $item['product'];
            $qty = $item['qty'];

            $id = $product->getId();
            $productImg = $product->getProductImg();
            $price = $product->getRegularPrice();
            $productCost = $price * $qty;

            $html .= <<<HTML
<li class="cart-item">
    <p class="name">$name</p>
    <p class="productImg"><img src="$productImg" /></p>
    <p class="qty"><input id="$id" type="number" name="qty" value="$qty"/></p>
    <p class="item-cost">$$productCost</p>
</li>
HTML;
        }
        $html .= <<<HTML
        </ul>
    </div>
    <hr>
    <div class="costs">
        <p class="cost">Total Cost: $$cost</p>
    </div>
</div>
HTML;
        return $html;
    }
}