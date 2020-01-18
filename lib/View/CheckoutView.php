<?php


namespace View;


use API\AddressTable;
use Model\Address;

class CheckoutView extends View {

    private $cart;
    private $address;

    public function __construct($site, $user, &$session) {
        parent::__construct($site, $user);
        $this->setTitle("Checkout");

        if(!$user->isMember()) {
            header("location: " . $this->getProtectRedirect());
            exit;
        }

        if(isset($session["cart"])) {
            $this->cart = $session['cart'];
        }

        $id = $user->getId();
        $addresses = new AddressTable($site);
        $this->address = $addresses->getByUser($id)[0];
    }

    public function present() {
        echo $this->head();
        echo '<body>';
        $user = $this->getUser();
        echo '<div id="checkout" class="'.$user->getId().'">';
        echo $this->nav();
        echo $this->address();
        echo $this->payment();
        echo $this->product();
        echo $this->total();
        echo '<button id="sq-creditcard" class="button-credit-card">Pay</button>';
        echo '</div>';
        echo $this->footer();
    }

    public function total() {
        $total = $this->cart->getCost();
        return <<<HTML
<div class="total-cost">
    <h2>Total: $<span id="totalCost">$total</span></h2>
</div>
HTML;
    }

    public function address() {
        return <<<HTML
<div class="address">
    <h2>Shipping Address</h2>
    <hr>
    <p>
        <label for="first-name">First Name: </label>
        <input type="text" id="first-name" name="first-name" placeholder="First Name">
    </p>
    <p>
        <label for="last-name">Last Name: </label>
        <input type="text" id="last-name" name="last-name" placeholder="Last Name">
    </p>
    <p>
        <label for="address1">Address1: </label>
        <input type="text" id="address1" name="address1" placeholder="Address1">
    </p>
    <p>
        <label for="address2">Address2: </label>
        <input type="text" id="address2" name="address2" placeholder="Address2">
    </p>
    <p>
        <label for="city">City: </label>
        <input type="text" id="city" name="city" placeholder="City">
    </p>
    <p>
        <label for="state">State: </label>
        <input type="text" id="state" name="state" placeholder="State">
    </p>
    <p>
        <label for="zip">Zip: </label>
        <input type="text" id="zip" name="zip" placeholder="Zip">
    </p>
</div>
<hr>
HTML;
    }

    public function payment() {

        return <<<HTML
<div id="form-container">
    <div id="sq-card-number"></div>
    <div class="third" id="sq-expiration-date"></div>
    <div class="third" id="sq-cvv"></div>
    <div class="third" id="sq-postal-code"></div>
</div>
HTML;
    }

    public function product() {
        $html = <<<HTML
<div class="product-info">
HTML;
        if(!empty($this->cart->getCart())) {
            foreach ($this->cart->getCart() as $item) {
                $name = $item['name'];
                $product = $item['product'];
                $qty = $item['qty'];
                $id = $product->getId();
                $productImg = $product->getProductImg();

                $html .= <<<HTML
<div id="$id" class="product">
    <p class="name">$name</p>
    <p class="productImg"><img src="$productImg" /></p>
    <p class="qty">Qty: $qty</p>
</div>
HTML;
            }
        }
        $cost = $this->cart->getCost();

        $html .= <<<HTML
<hr>
<div class="breakdown">
    <p class="shipping-cost">$0.00</p>
    <p class="tax-cost">$0.00</p>
    <p class="total-cost">$$cost</p>
</div>
<hr>
<div class="coupon">
    <p>
        <label for="coupon">Coupon: </label>
        <input type="text" name="coupon" placeholder="Coupon"/>
    </p>
</div>
HTML;
        return $html;
    }
}