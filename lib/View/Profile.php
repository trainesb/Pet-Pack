<?php


namespace View;


use Model\Site;
use Model\User;

class Profile extends View {

    private $customer;

    public function __construct(Site $site, User $user = null) {
        parent::__construct($site, $user);
        $this->setTitle('Profile');

        $this->customer = \Stripe\Customer::retrieve($user->getCustomerId());
    }

    public function present() {
        echo $this->userCard();
        echo $this->addressCard();
        //echo '<pre>' . var_export($this->customer, true) . '</pre>';;
    }

    public function userCard() {
        $username = $this->getUser()->getUsername();
        $id = $this->getUser()->getId();
        $email = $this->getUser()->getEmail();
        $name = $this->customer->name;
        $phone = $this->customer->phone;

        return <<<HTML
<div id="$id" class="user-card">
    <button id="edit-user">Edit</button>
    <p class="username">Username: $username</p>
    <p class="name">Name: $name</p>
    <p class="email">Email: $email</p>
    <p class="phone">Phone: $phone</p>
</div>

<form id="edit-user-card" hidden>
    <button id="cancel-user-edit">Cancel</button>
    <p>
        <label for="username">Username: $username</label>
    </p>
    <p>
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" value="$name">  
    </p>
    <p>
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" value="$email">  
    </p>
    <p>
        <label for="phone">Phone: </label>
        <input type="tel" id="phone" name="phone" value="$phone">  
    </p>
    <p><input type="submit" value="Save"></p>
</form>
HTML;
    }

    public function addressCard() {
        $address = $this->customer->address;
        $line1 = null;
        $line2 = null;
        $city = null;
        $country = null;
        $postal_code = null;
        $state = null;

        if($address) {
            $line1 = $address->line1;
            $line2 = $address->line2;
            $city = $address->city;
            $country = $address->country;
            $state = $address->state;
            $postal_code = $address->postal_code;
        }

        return <<<HTML
<div class="address-card">
    <button id="edit-address" class="edit">Edit</button>
    <p class="line1">Line 1: $line1</p>
    <p class="line2">Line 2: $line2</p>
    <p class="city">City: $city</p>
    <p class="country">Country: $country</p>
    <p class="state">State: $state</p>
    <p class="postal-code">Postal Code: $postal_code</p>
</div>

<form id="edit-address-card" hidden>
    <button id="cancel-address-edit">Cancel</button>
    <p>
        <label for="line1">Line1: </label>
        <input type="text" id="line1" name="line1" value="$line1">  
    </p>
    <p>
        <label for="line2">Line2: </label>
        <input type="text" id="line2" name="line2" value="$line2">  
    </p>
    <p>
        <label for="city">City: </label>
        <input type="text" id="city" name="city" value="$city">  
    </p>
    <p>
        <label for="country">Country: </label>
        <input type="text" id="country" name="country" value="$country">  
    </p>
    <p>
        <label for="state">State: </label>
        <input type="text" id="state" name="state" value="$state">  
    </p>
    <p>
        <label for="postal-code">Postal Code: </label>
        <input type="text" id="postal-code" name="postal-code" placeholder="$postal_code">
    </p>
    <p><input type="submit" value="Save"></p>
</form>
HTML;
    }
}