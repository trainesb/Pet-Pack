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
        echo '<pre>' . var_export($this->customer, true) . '</pre>';;
    }

    public function userCard() {
        $username = $this->getUser()->getUsername();
        $id = $this->getUser()->getId();
        $email = $this->getUser()->getEmail();
        $name = $this->customer->name;
        $phone = $this->customer->phone;

        return <<<HTML
<div id="$id" class="user-card">
    <p class="username">Username: $username</p>
    <p class="name">Name: $name</p>
    <p class="email">Email: $email</p>
    <p class="phone">Phone: $phone</p>
</div>
HTML;
    }

    public function addressCard() {
        $address = $this->customer->address;
        $line1 = 'Line 1';
        $line2 = 'Line 2';
        $city = 'City';
        $country = 'Country';
        $postal_code = 'ZIP';
        $state = 'State';

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
    <p class="line1">$line1</p>
    <p class="line2">$line2</p>
    <p class="city">$city</p>
    <p class="country">$country</p>
    <p class="state">$state</p>
    <p class="postal-code">$postal_code</p>
</div>
HTML;
    }
}