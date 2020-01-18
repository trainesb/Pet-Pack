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
        echo $this->address();
    }

    public function profile() {
        $customer = $this->customer->getCustomer();
        $id = $customer->getId();
        $birthday = $customer->getBirthday();
        $givenName = $customer->getGivenName();
        $email = $customer->getEmailAddress();
        $familyName = $customer->getFamilyName();
        $nickname = $customer->getNickname();
        $note = $customer->getNote();
        $phone = $customer->getPhoneNumber();
        return <<<HTML
<div class="customer">
    <h2>Profile</h2>
    <p class="edit-profile"><button>Edit</button></p>
    <p class="id">Id: <span>$id</span></p>
    <p class="nickname">Username: <span contenteditable="false">$nickname</span></p>
    <p class="givenName">First Name: <span contenteditable="false">$givenName</span></p>
    <p class="familyName">Last Name: <span contenteditable="false">$familyName</span></p>
    <p class="email">Email: <span contenteditable="false">$email</span></p>
    <p class="phone">Phone: <span contenteditable="false">$phone</span></p>
    <p class="birthday">Birthday: <span contenteditable="false">$birthday</span></p>
    <p class="note">Note: <span contenteditable="false">$note</span></p>
</div>
HTML;
    }

    public function address() {
        $customer = $this->customer->getCustomer();
        $customerId = $customer->getId();
        $address = $customer->getAddress();
        if ($address) {
            $first_name = $address->getFirstName();
            $last_name = $address->getLastName();
            $address1 = $address->getAddressLine1();
            $address2 = $address->getAddressLine2();
            $state = $address->getAdministrativeDistrictLevel1();
            $city = $address->getLocality();
            $postal_code = $address->getPostalCode();
        } else {
            $first_name = null;
            $last_name = null;
            $address1 = null;
            $address2 = null;
            $state = null;
            $city = null;
            $postal_code = null;
        }
        return <<<HTML
<div id="$customerId" class="address-wrapper">
    <h2>Address</h2>
    <p class="edit-address"><button>Edit</button></p>
    <p class="first_name">First Name: <span contenteditable="false">$first_name</span></p>
    <p class="last_name">Last Name: <span contenteditable="false">$last_name</span></p>
    <p class="address1">Address1: <span contenteditable="false">$address1</span></p>
    <p class="address2">Address2: <span contenteditable="false">$address2</span></p>
    <p class="state">State: <span contenteditable="false">$state</span></p>
    <p class="city">City: <span contenteditable="false">$city</span></p>
    <p class="postal_code">Postal Code: <span contenteditable="false">$postal_code</span></p>
</div>
HTML;
    }
}