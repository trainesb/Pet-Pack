<?php


namespace View;


class Register extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Register");
    }

    public function present() {
        echo $this->register();
    }

    public function register() {
        return <<<HTML
<form id="register">
    <fieldset>
        <legend>Register</legend>
        
        <p>
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" placeholder="Username">
        </p>
        
        <p>
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" placeholder="Email">
        </p>
        
        <p>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" placeholder="Password">
        </p>
        
        <p>
            <label for="confirm-password">Password Again: </label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Password">
        </p>
        
        <p><input type="submit" value="Register"></p>
    </fieldset>
</form>
HTML;
    }
}