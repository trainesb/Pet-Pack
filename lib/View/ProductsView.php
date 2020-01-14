<?php


namespace View;


use API\ProductTable;
use Model\Product;

class ProductsView extends View {

    private $products;

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Products");

        if(!$this->protect($site, $user)) {
            header("location: " . $this->getProtectRedirect());
            exit;
        }

        $products = new ProductTable($site);
        $this->products = $products->getAll();
    }

    public function products() {
        $html = '<div class="products-wrapper">';
        if(!empty($this->products)) {
            foreach ($this->products as $product) {
                $product = new Product($product);
                $id = $product->getId();
                $sku = $product->getSku();
                $name = $product->getName();
                $productImg = $product->getProductImg();
                $shortDescription = $product->getShortDescription();
                $description = $product->getDescription();
                $regularPrice = $product->getRegularPrice();
                $salePrice = $product->getSalePrice();
                $soldOut = $product->getSoldOut();
                $quantity = $product->getQuantity();
                $purchaseNote = $product->getPurchaseNote();
                $hasReview = $product->getHasReview();
                $weight = $product->getWeight();
                $height = $product->getHeight();
                $length = $product->getLength();
                $width = $product->getWeight();
                $gallery = $product->getGallery();

                $html .= <<<HTML
<div class="product-card">
    <button id="$id" class="delete-product">X</button>
    <p class="sku">SKU: $sku</p>
    <h1 class="name"><a href="./product.php?name=$name&id=$id">$name</a></h1>
    <p class="productImg"><img src="$productImg" /></p>
    <p class="shortDescription">$shortDescription</p>
    <p class="regularPrice">$$regularPrice</p>
</div>
HTML;
            }
        }
        $html .= "</div>";
        return $html;
    }

    public function present() {
        echo $this->head();

        echo '<div id="products">';
        echo $this->nav();
        echo $this->products();
        echo '</div>';
        echo $this->footer();
    }
}