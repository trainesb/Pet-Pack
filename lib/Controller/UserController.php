<?php


namespace Controller;


use API\UserTable;
use Model\Site;
use Model\User;
use Stripe\Exception\ApiErrorException;

class UserController {

    const ADD = 'A';
    const DELETE = 'D';
    const UPDATE = 'U';

    private $users;
    private $user;
    private $result;

    public function __construct(Site $site, User $user,$method) {
        $this->users = new UserTable($site);
        $this->user = $user;

        switch ($method) {
            case self::ADD:
                if ($this->add())
                    $this->result = json_encode(['ok' => true]);
                else
                    $this->result = json_encode(['ok' => false, 'message' => 'Error creating new user']);
                break;
            case self::DELETE:
                $this->delete();
                break;
            case self::UPDATE:
                if ($this->update())
                    $this->result = json_encode(['ok' => true]);
                else
                    $this->result = json_encode(['ok' => false, 'message' => 'Error updating user']);
                break;
            default:
                $this->result = json_encode(['ok' => false, 'message' => 'Error unknown method']);
        }
    }

    private function add() {
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

    private function delete() {

    }

    private function update() {
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

    public function getResult() { return $this->result; }

}