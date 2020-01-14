<?php


namespace View;


class ProductsView extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("All Products");

        if(!$this->protect($site, $user)) {
            header("location: " . $this->getProtectRedirect());
            exit;
        }
    }

    public function present() {
        echo $this->head();

        echo '<div id="products">';
        echo $this->nav();
        echo '</div>';
        echo $this->footer();
    }
}