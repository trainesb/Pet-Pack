<?php


namespace Controller;


use API\UserTable;
use Model\Site;
use Model\User;
use Stripe\Exception\ApiErrorException;

class UserController extends Controller {

    private $users;
    private $user;

    public function __construct(Site $site, User $user,$method) {
        parent::__construct($method);
        $this->users = new UserTable($site);
        $this->user = $user;
    }

    protected function add() {
        $customer = \Stripe\Customer::create([
            'email' => $_POST['email'],
            'metadata' => ['username' => $_POST['username']],
        ]);
        $id = $customer->id;

        $user = [
          'customerId' => $id,
          'username' => $_POST['username'],
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ];

        return $this->users->addUser($user);
    }

    protected function delete() {

    }

    protected function update() {
        if(isset($_POST['city']))
            return $this->updateAddress();
        else
            return $this->updateUser();
    }

    private function updateUser() {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone']
        ];

        return $this->updateCustomer($data);
    }

    private function updateAddress() {
        $data = [
            'address' => [
                'line1' => $_POST['line1'],
                'line2' => $_POST['line2'],
                'city' => $_POST['city'],
                'country' => $_POST['country'],
                'state' => $_POST['state'],
                'postal_code' => $_POST['postal-code']
            ]
        ];

        return $this->updateCustomer($data);
    }

    private function updateCustomer($data) {
        try {
            \Stripe\Customer::update($this->user->getCustomerId(), $data);
            return true;
        } catch (ApiErrorException $e) {
            return false;
        }
    }

}