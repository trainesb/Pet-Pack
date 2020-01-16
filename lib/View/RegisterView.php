<?php


namespace View;


class RegisterView extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Register");
    }

    public function present() {
        $registerForm = new Form\CreateCustomer();

        echo '<div id="register">';
        echo $this->nav();
        echo $registerForm->present();
        echo '</div>';
        echo $this->footer();
    }
}