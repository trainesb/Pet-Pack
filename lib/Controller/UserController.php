<?php


namespace Controller;


use API\UserTable;
use Model\Site;

class UserController {

    const ADD = 'A';
    const DELETE = 'D';
    const UPDATE = 'U';

    private $users;
    private $result;

    public function __construct(Site $site, $method) {
        $this->users = new UserTable($site);

        switch ($method) {
            case self::ADD:
                if ($this->add()) $this->result = json_encode(['ok' => true]);
                else $this->result = json_encode(['ok' => false, 'message' => 'Error creating new user']);
                break;
            case self::DELETE:
                $this->delete();
                break;
            case self::UPDATE:
                $this->update();
                break;
            default:
                echo '<p>Unknown Method: '.$method.'</p>';
        }
    }

    private function add() {
        $customer = \Stripe\Customer::create([
            'email' => $_POST['email'],
            'metadata' => ['username' => $_POST['username']],
        ]);
        $id = $customer->id;
        echo '<pre>' . var_export($customer, true) . '</pre>';

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

    }

}