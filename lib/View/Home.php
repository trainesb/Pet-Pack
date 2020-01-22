<?php


namespace View;


class Home extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Home");

    }

}