<?php


namespace View;


use API\ProductTable;
use Model\Product;

class HomeView extends View {

    private $products = [];

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Home");

        $products = new ProductTable($site);
        $products = $products->getAll();
        foreach ($products as $product) {
            array_push($this->products, new Product($product));
        }
    }

    public function products() {
        $html = '<div class="products-wrapper">';
        if(!empty($this->products)) {
            foreach ($this->products as $product) {
                $id = $product->getId();
                $sku = $product->getSku();
                $name = $product->getName();
                $productImg = $product->getProductImg();
                $shortDescription = $product->getShortDescription();
                $regularPrice = $product->getRegularPrice();

                $html .= <<<HTML
<div id="$id" class="product-card">
    <p class="sku">SKU: $sku</p>
    <h1 class="name"><a href="./product.php?name=$name&id=$id">$name</a></h1>
    <p class="productImg"><img src="$productImg" /></p>
    <p class="shortDescription">$shortDescription</p>
    <p class="regularPrice">$$regularPrice</p>
</div>
HTML;
            }
        }
        $html .= '</div>';
        return $html;
    }

    public function present() {
        echo $this->head();

        echo '<div id="home">';
        echo $this->nav();
        echo $this->products();
        echo '</div>';

        echo $this->footer();
    }
}