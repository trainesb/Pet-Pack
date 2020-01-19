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
        // Profile
        $id = $customer->getId();
        $birthday = $customer->getBirthday();
        $givenName = $customer->getGivenName();
        $email = $customer->getEmailAddress();
        $familyName = $customer->getFamilyName();
        $nickname = $customer->getNickname();
        $note = $customer->getNote();
        $phone = $customer->getPhoneNumber();

        $address = $customer->getAddress();
        if ($address) {
            $address1 = $address->getAddressLine1();
            $address2 = $address->getAddressLine2();
            $state = $address->getAdministrativeDistrictLevel1();
            $city = $address->getLocality();
            $postal_code = $address->getPostalCode();
        } else {
            $address1 = null;
            $address2 = null;
            $state = null;
            $city = null;
            $postal_code = null;
        }

        return <<<HTML
<div class="customer">
    <h2>Profile</h2>
    <p class="edit-profile"><button>Edit</button></p>
    <p class="id">Id: <span>$id</span></p>
    <label>Username:</label>
    <p class="nickname" contenteditable="false">$nickname</p>
    <label>First Name:</label>
    <p class="givenName" contenteditable="false">$givenName</p>
    <label>Last Name:</label>
    <p class="familyName" contenteditable="false">$familyName</p>
    <label>Email:</label>
    <p class="email" contenteditable="false">$email</p>
    <label>Phone:</label>
    <p class="phone" contenteditable="false">$phone</p>
    <label>Birthday:</label>
    <p class="birthday" contenteditable="false">$birthday</p>
    <label>Note:</label>
    <p class="note" contenteditable="false">$note</p>

    <label>Address1: </label>
    <p class="address1" contenteditable="false">$address1</p>
    <label>Address2: </label>
    <p class="address2" contenteditable="false">$address2</p>
    <label>State: </label>
    <p class="state" contenteditable="false">$state</p>
    <label>City: </label>
    <p class="city" contenteditable="false">$city</p>
    <label>Zip: </label>
    <p class="postal_code" contenteditable="false">$postal_code</p>
</div>
HTML;
    }
}