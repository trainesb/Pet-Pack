<?php


namespace View;


use API\AddressTable;
use API\PaymentCardTable;
use Model\Address;
use Model\PaymentCard;
use View\Form\CreateAddress;

class ProfileView extends View {

    private $address;
    private $id;
    private $paymentCards;

    public function __construct($site, $user, $api_client) {
        parent::__construct($site, $user, $api_client);
        $this->setTitle("Profile");

        if(!$user->isMember()) {
            header("location: " . $this->getProtectRedirect());
            exit;
        }

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
        echo '</div>';
        echo $this->footer();
    }

    public function address() {
        $createAddress = new CreateAddress();
        return $createAddress->present();
    }

    public function profile() {
        $user = $this->getUser();
        $customerId = $user->getCustomerId();

        $api_client = $this->getApiClient();
        $customersApi = new \SquareConnect\Api\CustomersApi($api_client);
        $customer = $customersApi->retrieveCustomer($customerId)->getCustomer();
        $id = $customer->getId();
        $joined = $customer->getCreatedAt();
        $cards = $customer->getCards();
        $firstName = $customer->getGivenName();
        $lastName = $customer->getFamilyName();
        $username = $customer->getNickname();
        $email = $customer->getEmailAddress();
        $address = $customer->getAddress();
        $phone = $customer->getPhoneNumber();
        $birthday = $customer->getBirthday();

        return <<<HTML
<div id="$id" class="customer-card">
    <p class="username">Username: $username</p>
    <p class="first-name">First Name: $firstName</p>
    <p class="last-name">Last Name: $lastName</p>
    <p class="email">Email: $email</p>
    <p class="address">Address: $address</p>
    <p class="phone">Phone: $phone</p>
    <p class="birthday">Birthday: $birthday</p>
    <p class="cards">Cards: $cards</p>
    <p class="joined">Joined $joined</p>
</div>
HTML;
    }
}