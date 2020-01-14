<?php


namespace View;


use API\AddressTable;
use API\PaymentCardTable;
use Model\Address;
use Model\PaymentCard;

class ProfileView extends View {

    private $address;
    private $id;
    private $paymentCards;

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Profile");

        $this->id = $user->getid();

        $addressTable = new AddressTable($site);
        $this->address = $addressTable->getByUser($this->id);

        $cardTable = new PaymentCardTable($site);
        $this->paymentCards = $cardTable->getByUser($this->id);
    }

    public function present() {
        echo $this->head();
        echo $this->nav();

        echo '<div id="profile">';
        echo $this->profile();
        echo $this->address();
        echo $this->paymentCard();
        echo '</div>';
        echo $this->footer();
    }

    public function address() {
        $html = '<div class="address-wrapper">';
        $html .= '<h2>Addresses</h2>';
        $html .= '<button id="add-address">Add Address</button>';
        if(!empty($this->address)) {
            foreach ($this->address as $address) {
                $address = new Address($address);
                $id = $address->getId();
                $userId = $address->getUserId();
                $fullName = $address->getFullName();
                $address1 = $address->getAddress1();
                $address2 = $address->getAddress2();
                $city = $address->getCity();
                $state = $address->getState();
                $zip = $address->getZip();

                $html .= <<<HTML
<div id="$id" class="address-card">
    <p class="fullName">$fullName</p>
    <p class="address1">$address1</p>
    <p class="city state zip">$city, $state $zip</p>
</div>
HTML;
            }
        }
        $html .= <<<HTML
<div id="" class="add-address">
    <form id="add-address" class="$this->id">
        <fieldset>
            <legend>Add Address</legend>
            <p>
                <label for="firstName">First Name: </label>
                <input type="text" name="firstName" placeholder="First Name"/>
            </p>
            <p>
                <label for="lastName">Last Name: </label>
                <input type="text" name="lastName" placeholder="Last Name"/>
            </p>
            <p>
                <label for="address1">Address Line 1: </label>
                <input type="text" name="address1" placeholder="Address..."/>
            </p>
            <p>
                <label for="address2">Address Line 2: </label>
                <input type="text" name="address2" placeholder="..."/>
            </p>
            <p>
                <label for="city">City: </label>
                <input type="text" name="city" placeholder="City"/>
            </p>
            <p>
                <label for="state">State: </label>
                <input type="text" name="state" placeholder="State"/>
            </p>
            <p>
                <label for="zip">Zip: </label>
                <input type="number" name="zip" value="00000"/>
            </p>
            <p><input type="submit" value="Add"/></p>
        </fieldset>
    </form>
</div>
</div>
HTML;
        return $html;
    }

    public function paymentCard() {
        $html = '<div class="paymentCard-wrapper">';
        $html .= '<h2>Payment Cards</h2>';
        $html .= '<button id="add-paymentCard">Add Payment Card</button>';
        if(!empty($this->paymentCards)) {
            foreach ($this->paymentCards as $paymentCard) {
                $paymentCard = new PaymentCard($paymentCard);
                $id = $paymentCard->getId();
                $userId = $paymentCard->getUserId();
                $alias = $paymentCard->getAlias();
                $fullName = $paymentCard->getFullName();
                $cardNumber = $paymentCard->getCardNumber();
                $vcc = $paymentCard->getVcc();
                $zip = $paymentCard->getZip();

                $html .= <<<HTML
<div id="$id" class="paymentCard-card">
    <p class="alias">$alias</p>
    <p class="fullName">$fullName</p>
    <p class="cardNumber">$cardNumber</p>
</div>
HTML;
            }
        } else {
            $html .= <<<HTML
<div id="" class="paymentCard-card">
    <p class="alias">Alias</p>
    <p class="fullName">Full Name</p>
    <p class="cardNumber">Card Number</p>
</div>
HTML;
        }
        $html .= <<<HTML
<div id="" class="add-paymentCard">
    <form id="add-payment" class="$this->id">
        <fieldset>
            <legend>Add Payment</legend>
            <p>
                <label for="alias">Alias: </label>
                <input type="text" name="alias" placeholder="Alias"/>
            </p>
            <p>
                <label for="fullName">Full Name: </label>
                <input type="text" name="fullName" placeholder="Full Name"/>
            </p>
            <p>
                <label for="cardNumber">Card Number: </label>
                <input type="number" name="cardNumber" value="0000 0000 0000 0000"/>
            </p>
            <p>
                <label for="vcc">VCC: </label>
                <input type="number" name="vcc" value="000"/>
            </p>
            <p>
                <label for="zip">Zip: </label>
                <input type="number" name="zip" value="00000"/>
            </p>
            <p><input type="submit" value="Add"/></p>
        </fieldset>
    </form>
</div>
</div>
HTML;
        return $html;
    }

    public function profile() {
        $user = $this->getUser();
        $id = $this->id;
        $username = $user->getUsername();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $phone = $user->getPhone();
        $profileImg = $user->getProfileImg();
        $role = $user->getRole();
        $joined = date("Y-m-d", $user->getJoined());

        return <<<HTML
<div id="$id" class="user-card">
    <h2 class="username">$username</h2>
    <p class="profileImg"><img src="$profileImg" /></p>
    <h3 class="name">$firstName $lastName</h3>
    <p class="email">$email</p>
    <p class="phone">$phone</p>
    <p class="role">$role</p>
    <p class="joined">$joined</p>
</div>
HTML;
    }
}