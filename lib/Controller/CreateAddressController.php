<?php


namespace Controller;


use Model\Site;

class CreateAddressController {

    private $result;

    private $firstName;
    private $lastName;
    private $address1;
    private $address2;
    private $country;
    private $state;
    private $city;
    private $zip;

    private $customerAddress;

    public function __construct(Site $site) {
        if(!empty($_POST)) {
            $this->firstName = $_POST['firstName'];
            $this->lastName = $_POST['lastName'];
            $this->address1 = $_POST['address1'];
            $this->address2 = $_POST['address2'];
            $this->country = $_POST['country'];
            $this->state = $_POST['state'];
            $this->city = $_POST['city'];
            $this->zip = $_POST['zip'];

            $this->setAddress();
        }
    }

    public function setAddress() {
        $this->customerAddress = new \SquareConnect\Model\Address();

        $this->customerAddress->setFirstName($this->firstName);
        $this->customerAddress->setLastName($this->lastName);
        $this->customerAddress->setAddressLine1($this->address1);
        $this->customerAddress->setAddressLine2($this->address2);
        $this->customerAddress->setCountry($this->country);
        $this->customerAddress->setSublocality($this->state);
        $this->customerAddress->setSublocality2($this->city);
        $this->customerAddress->setPostalCode($this->zip);
    }

    public function getResult() { return $this->result; }
}