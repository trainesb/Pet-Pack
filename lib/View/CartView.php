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
        echo '</div>';
        echo $this->footer();
    }
}