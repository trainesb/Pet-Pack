<?php


namespace View;


class CreateProductView extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Add Product");

        if(!$this->protect($site, $user)) {
            header("location: " . $this->getProtectRedirect());
            exit;
        }
    }

    public function present() {
        echo $this->head();

        echo '<div id="createProduct">';
        echo $this->nav();
        echo '</div>';
        echo $this->footer();
    }
}