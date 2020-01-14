<?php


namespace Controller;


use API\UserTable;
use Model\Site;

class DeleteUserController {

    private $result;

    public function __construct(Site $site) {
        $users = new UserTable($site);
        if(isset($_POST['id'])) {
            if(!$users->deleteById($_POST['id'])) {
                $this->result = json_encode(["ok" => true]);
                return;
            }
        }
        $this->result = json_encode(["ok" => false, "message" => "Error deleting user!"]);
    }

    public function getResult() {
        return $this->result;
    }
}