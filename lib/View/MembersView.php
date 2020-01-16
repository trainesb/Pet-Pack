<?php


namespace View;


class MembersView extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Members");

        if(!$this->protect($site, $user)) {
            header("location: " . $this->getProtectRedirect());
            exit;
        }
    }

    public function customers() {
        $api_client = $this->getApiClient();
        $customersApi = new \SquareConnect\Api\CustomersApi($api_client);

        $customers = $customersApi->listCustomers();
        $customers = $customers->getCustomers();

        $html = '<div class="customer-cards">';
        foreach ($customers as $customer) {
            $html .= $this->customer($customer);
        }
        $html .= '</div>';
        return $html;
    }

    public function customer($customer) {
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

    public function present() {
        echo $this->head();

        echo '<div id="members">';
        echo $this->nav();
        echo $this->customers();
        echo '</div>';
        echo $this->footer();
    }
}