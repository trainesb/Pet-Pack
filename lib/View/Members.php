<?php


namespace View;


use Model\Site;
use Model\User;

class Members extends View {

    private $customersApi;

    public function __construct(Site $site, User $user = null, $api_client = null) {
        parent::__construct($site, $user, $api_client);

        if(!$user->isAdmin()) {
            header("location: ".$this->getProtectRedirect());
        }

        $this->setTitle("Members");
        $this->customersApi = new \SquareConnect\Api\CustomersApi($api_client);
    }

    public function present() {
        echo $this->adminNav();
        echo $this->customers();
    }

    public function customers() {
        $customersApi = $this->customersApi;
        $customers = $customersApi->listCustomers();
        $customers = $customers->getCustomers();
        $html = '<div class="customers">';
        if($customers) {
            foreach ($customers as $customer) {
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
                $html .= <<<HTML
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
        $html .= '</div>';
        return $html;
    }

    public function adminNav() {
        return <<<HTML
<nav id='adminNav'>
    <ul>
        <li><a href="./add-product.php">Add a Product</a></li>
        <li><a href="./members.php">Members</a></li>
        <li><a href="./products.php">Products</a></li>
    </ul>
</nav>
HTML;
    }
}