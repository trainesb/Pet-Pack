<?php


namespace Controller;


class UpdateAddressController {

    private $result;

    public function __construct($site, $user, $api_client) {

        $address = new \SquareConnect\Model\Address();
        $address->setGivenName($_POST['firstName']);
        $address->setFamilyName($_POST['lastName']);
        $address->setAddressLine1($_POST['address1']);
        $address->setAddressLine2($_POST['address2']);
        $address->setAdministrativeDistrictLevel1($_POST['state']);
        $address->setLocality($_POST['city']);
        $address->setPostalCode($_POST['postalCode']);

        $body = new \SquareConnect\Model\UpdateCustomerRequest();
        $body->setAddress($address);

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