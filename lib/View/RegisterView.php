<?php


namespace View;


class RegisterView extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Register");
    }

    public function present() {
        echo $this->head();

        echo '<div id="register">';
        echo $this->nav();
        echo '</div>';
        echo $this->footer();
    }
}