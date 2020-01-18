<?php


namespace View;


use Model\Site;
use Model\User;

class Profile extends View {

    private $customer;

    public function __construct(Site $site, User $user = null, $api_client = null) {
        parent::__construct($site, $user, $api_client);

        if(!$user->isMember()) { header("location: ".$this->getProtectRedirect()); }

        $this->setTitle("Profile");
        $customersApi = new \SquareConnect\Api\CustomersApi($api_client);
        $this->customer = $customersApi->retrieveCustomer($user->getCustomerId());
    }

    public function present() {
        echo $this->profile();
    }

    public function profile() {
        $customer = $this->customer->getCustomer();
        $id = $customer->getId();
        $address = $customer->getAddress();
        $birthday = $customer->getBirthday();
        $givenName = $customer->getGivenName();
        $cards = $customer->getCards();
        $email = $customer->getEmailAddress();
        $familyName = $customer->getFamilyName();
        $nickname = $customer->getNickname();
        $note = $customer->getNote();
        $phone = $customer->getPhoneNumber();
        return <<<HTML
<div class="customer">
    <p class="id">Id: $id</p>
    <p class="address">Address: $address</p>
    <p class="birthday">Birthday: $birthday</p>
    <p class="givenName">Given Name: $givenName</p>
    <p class="cards">Cards: $cards</p>
    <p class="email">Email: $email</p>
    <p class="familyName">Family Name: $familyName</p>
    <p class="nickname">Nickname: $nickname</p>
    <p class="note">Note: $note</p>
    <p class="phone">Phone: $phone</p>
</div>
HTML;
    }
}