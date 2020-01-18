<?php


namespace Controller;


use API\UserTable;

class RegisterController {

    private $result;
    private $site;

    public function __construct($site) {
        $this->site = $site;
        $id = $this->squareCreateCustomer($_POST['username'], $_POST['email']);
        $this->addCustomer($id, $_POST['username'], $_POST['email'], $_POST['password']);
    }

    public function addCustomer($id, $username, $email, $password) {
        $users = new UserTable($this->site);
        if($users->addUser($id, $username, $email, $password)) {
            $this->result = json_encode(["ok" => true]);
            return;
        }
        $this->result = json_encode(["ok" => false, 'message' => "Error adding user to the database"]);
    }

    public function squareCreateCustomer($username, $email) {

        $customer = new \SquareConnect\Model\CreateCustomerRequest();
        $customer->setEmailAddress($email);
        $customer->setNickname($username);

        $dotenv = \Dotenv\Dotenv::create(__DIR__.'\..\..');
        $dotenv->load();

        $access_token = ($_ENV["USE_PROD"] == 'true')  ?  $_ENV["PROD_ACCESS_TOKEN"] : $_ENV["SANDBOX_ACCESS_TOKEN"];
        $host_url = ($_ENV["USE_PROD"] == 'true')  ?  "https://connect.squareup.com" : "https://connect.squareupsandbox.com";
        $api_config = new \SquareConnect\Configuration();
        $api_config->setHost($host_url);
        $api_config->setAccessToken($access_token);
        $api_client = new \SquareConnect\ApiClient($api_config);

        $customersApi = new \SquareConnect\Api\CustomersApi($api_client);

        // Call CreateCustomer
        try {
            $result = $customersApi->createCustomer($customer);
            return $result->getCustomer()->getId();

            //print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling CustomersApi->createCustomer: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function getResult() { return $this->result; }
}