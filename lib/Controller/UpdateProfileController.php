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

        $customerApi = new \SquareConnect\Api\CustomersApi($api_client);

        try {
            $result = $customerApi->updateCustomer($_POST['customerId'], $body);
            echo '<pre>' . var_export($result, true) . '</pre>';
        } catch (\Exception $e) {
            echo 'Exception when calling CustomersApi->updateCustomer: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function getResult() { return $this->result; }
}