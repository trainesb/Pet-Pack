<?php


namespace View;


use API\AddressTable;
use API\PaymentCardTable;
use Model\Address;
use Model\PaymentCard;

class CheckoutView extends View {

    private $cart;
    private $address;
    private $paymentCard;

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

        $cards = new PaymentCardTable($site);
        $this->paymentCard = $cards->getByUser($id)[0];
    }

    public function present() {
        echo $this->head();

        echo '<div id="checkout">';
        echo $this->nav();
        echo $this->address();
        echo $this->paymentCard();
        echo $this->product();
        echo '</div>';
        echo $this->footer();
    }

    public function address() {
        $address = new Address($this->address);
        $name = $address->getFullName();
        $address1 =  $address->getAddress1();
        $city = $address->getCity();
        $state = $address->getState();
        $zip = $address->getZip();

        return <<<HTML
<div class="address">
    <h2>Shipping Address</h2>
    <hr>
    <p class="name">$name</p>
    <p class="address1">$address1</p>
    <p class="city state zip">$city, $state $zip</p>
</div>
HTML;
    }

    public function paymentCard() {
        $paymentCard = new PaymentCard($this->paymentCard);
        $alias = $paymentCard->getAlias();
        $name = $paymentCard->getFullName();

        return <<<HTML
<div class="payment">
    <h2>Payment</h2>
    <hr>
    <p class="alias">$alias</p>
    <p class="name">$name</p>
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
                $productImg = $product->getProductImg();

                $html .= <<<HTML
<div class="product">
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