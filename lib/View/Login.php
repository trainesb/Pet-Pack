<?php


namespace View;


use API\CookieTable;

class Login extends View {

    public function __construct($site, $user, $cookie) {
        parent::__construct($site, $user);
        $this->setTitle("Login");

        if(isset($cookie[LOGIN_COOKIE]) && $cookie[LOGIN_COOKIE] != "") {
            $cookie = json_decode($cookie[LOGIN_COOKIE], true);
            $cookies = new CookieTable($site);
            $hash = $cookies->validate($cookie['user'], $cookie['token']);
            if($hash !== null) {
                $cookies->delete($hash);
            }

            $expire = time() - 3600;
            setcookie(LOGIN_COOKIE, "", $expire, "/");
        }
    }

    public function present() {
        echo $this->presentForm();
    }

    public function presentForm() {
        return <<<HTML
<form id="loginForm" method="post" action="post/login.php">
    <fieldset>
        <legend>Login</legend>

        <p><label for="username">Username: </label>
        <input type="text" id="username" name="username" placeholder="Username" autocomplete="Username" required></p>

        <p><label for="password">Password: </label>
        <input type="password" id="password" name="password" minlength="8" maxlength="20" placeholder="Password" autocomplete="current-password" required></p>

        <p class="keep"><input type="checkbox" name="keep" id="keep">
		<label for="keep">Keep me logged on</label></p>

        <p><input type="submit" value="Log in"></p>
        <p><a href="">Lost Password</a></p>

        <p><a href="..">BT Glass Home</a></p>
        <p><a href="./register.php">Become a Member</a></p>
    </fieldset>
    
    <div class="message"></div>
</form>
HTML;
    }

}