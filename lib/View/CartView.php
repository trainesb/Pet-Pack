<?php


namespace View;


class CartView extends View {

    private $cart;

    public function __construct($site, $user, &$session) {
        parent::__construct($site, $user);
        $this->setTitle("Cart");


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
        return <<<HTML
<div class="cart">
    <h2>Cart</h2>
    <hr>
    <ul class="cart-items">
        <li>
            <p>Item</p>
        </li>
    </ul>
    <hr>
</div>
HTML;
    }
}