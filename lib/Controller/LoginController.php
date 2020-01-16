<?php


namespace Controller;


use API\CookieTable;
use API\UserTable;
use Model\Site;
use Model\User;

class LoginController {

    private $result;

    public function __construct(Site $site, array &$session, array $post) {

        // Create a Users object to access the table
        $users = new UserTable($site);

        $username = strip_tags($post['username']);
        $password = strip_tags($post['password']);
        $user = $users->login($username, $password);
        $session[User::SESSION_NAME] = $user;

        if($user === null) {
            if(!$users->exists($username)) {
                $this->result = json_encode(['ok' => false, 'message' => 'Invalid Username']);
            } else {
                $this->result = json_encode(['ok' => true, 'admin' => false]);
            }
        } else {
            if($user->isAdmin()) {
                $this->result = json_encode(['ok' => true, 'admin' => true]);
            } else {
                $this->result = json_encode(['ok' => true, 'admin' => false]);
            }
        }

        if(isset($post['keep'])) {
            $cookies = new CookieTable($site);
            $token = $cookies->create($user);
            $expire = time() + (86400 * 365); // 86400 = 1 day
            $user_id = $user->getId();
            $cookie = array("user" => $user_id, "token" => $token);
            setcookie(LOGIN_COOKIE, json_encode($cookie), $expire, "/");
        }
    }

    public function getResult() {
        return$this->result;
    }
}