<?php


namespace View;


use Model\Site;
use Model\User;

class AddProduct extends View {

    private $createProduct;

    public function __construct(Site $site, User $user = null, $api_client = null) {
        parent::__construct($site, $user, $api_client);

        if(!$user->isAdmin()) {
            header("location: ". $this->getProtectRedirect());
        }
        $this->setTitle("Add Product");
        $this->createProduct = new Form\CreateProduct();
    }

    public function present() {
        echo "<h1>Add a Product</h1>";
        echo $this->adminNav();
        echo $this->createProduct->present();
    }

    public function adminNav() {
        return <<<HTML
<nav id='adminNav'>
    <ul>
        <li><a href="./add-product.php">Add a Product</a></li>
        <li><a href="">Members</a></li>
        <li><a href="./products.php">Products</a></li>
    </ul>
</nav>
HTML;
    }
}