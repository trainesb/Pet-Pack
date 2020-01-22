<?php


namespace View;


class Admin extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Admin");

        if(!$this->protect($site, $user)) {
            header("location: " . $this->getProtectRedirect());
            exit;
        }
    }

    public function present() {
        echo '<p><a href="./add-product.php">Add Product</a></p>';
        echo '<p><a href="./products.php">Products</a></p>';
    }

}