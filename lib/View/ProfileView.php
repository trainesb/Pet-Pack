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

    public function __construct($site, $user) {
        parent::__construct($site, $user);
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