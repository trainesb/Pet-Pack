<?php


namespace View;


use Model\Site;
use Model\User;

class Products extends View {

    private $products;

    public function __construct(Site $site, User $user = null, $api_client = null) {
        parent::__construct($site, $user, $api_client);

        if(!$user->isAdmin()) {
            header("location: ". $this->getProtectRedirect());
        }

        $this->setTitle("Products");

        $catalogApi = new \SquareConnect\Api\CatalogApi($api_client);
        $this->products = $catalogApi->listCatalog()->getObjects();

    }

    public function present() {
        echo $this->adminNav();
        echo $this->products();
    }

    public function products() {
        $html = '<div class="products-wrapper">';
        foreach ($this->products as $product) {
            $id = $product->getId();
            $itemData = $product->getItemData();
            $name = $itemData->getName();
            $description = $itemData->getDescription();
            $abbreviation = $itemData->getAbbreviation();

            $html .= <<<HTML
<div id="$id" class="product">
    <p><a href="./edit-product.php?id=$id">Edit</a></p>
    <h3 class="name">$name</h3>
    <p class="description">$description</p>
    <p class="abbreviation">$abbreviation</p>
</div>
HTML;
        }
        $html .= "</div>";
        return $html;
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