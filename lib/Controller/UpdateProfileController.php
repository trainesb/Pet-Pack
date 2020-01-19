<?php


namespace Controller;


class UpdateProfileController {

    private $result;

    public function __construct($site, $user, $api_client) {

        $body = new \SquareConnect\Model\UpdateCustomerRequest();
        $body->setNickname($_POST['nickname']);
        $body->setGivenName($_POST['givenName']);
        $body->setFamilyName($_POST['familyName']);
        $body->setEmailAddress($_POST['email']);
        $body->setPhoneNumber($_POST['phone']);
        $body->setBirthday($_POST['birthday']);
        $body->setNote($_POST['note']);

        $address = new \SquareConnect\Model\Address();
        $address->setAddressLine1($_POST['address1']);
        $address->setAddressLine2($_POST['address2']);
        $address->setAdministrativeDistrictLevel1($_POST['state']);
        $address->setLocality($_POST['city']);
        $address->setPostalCode($_POST['postalCode']);
        $body->setAddress($address);

        $customerApi = new \SquareConnect\Api\CustomersApi($api_client);

        try {
            $result = $customerApi->updateCustomer($_POST['customerId'], $body);
            //echo '<pre>' . var_export($result, true) . '</pre>';
        } catch (\Exception $e) {
            echo 'Exception when calling CustomersApi->updateCustomer: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function getResult() { return $this->result; }
}