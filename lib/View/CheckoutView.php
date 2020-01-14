<?php


namespace View;


class CheckoutView extends View {

    private $cart;

    public function __construct($site, $user, &$session) {
        parent::__construct($site, $user);
        $this->setTitle("Checkout");

        if(isset($session["cart"])) {
            $this->cart = $session['cart'];
        }
    }

    public function present() {
        echo $this->head();

        echo '<div id="checkout">';
        echo $this->nav();
        echo '</div>';
        echo $this->footer();
    }
}