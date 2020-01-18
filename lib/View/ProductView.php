<?php


namespace View;


use API\ProductTable;
use Model\Product;

class ProductView extends View {

    private $product;

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle($_GET["name"]);

        $products = new ProductTable($site);
        $product = $products->getById($_GET["id"]);
        $this->product = new Product($product);
    }

    public function product() {
        $id = $this->product->getId();
        $sku = $this->product->getSku();
        $name = $this->product->getName();
        $productImg = $this->product->getProductImg();
        $shortDescription = $this->product->getShortDescription();
        $description = $this->product->getDescription();
        $regularPrice = $this->product->getRegularPrice();
        $salePrice = $this->product->getSalePrice();
        $soldOut = $this->product->getSoldOut();
        $quantity = $this->product->getQuantity();
        $purchaseNote = $this->product->getPurchaseNote();
        $hasReview = $this->product->getHasReview();
        $weight = $this->product->getWeight();
        $height = $this->product->getHeight();
        $length = $this->product->getLength();
        $width = $this->product->getWeight();
        $gallery = $this->product->getGallery();

        return <<<HTML
<div id="$id" class="product-wrapper">
    <div class="product-info">
    
        <div class="left">
            <p class="productImg"><img src="$productImg" /></p>
        </div>
        
        <div class="right">
            <h1 class="name" contenteditable="false">$name</h1>
            <p class="sku">SKU: <span contenteditable="false">$sku</span></p>
            <h2 class="shortDescription" contenteditable="false">$shortDescription</h2>
            <br/>
            <h3>$<span class="regularPrice" contenteditable="false">$regularPrice</span></h3>
            <form id="product-order">
                <input type="number" name="qty" id="qty" value=0>
                <input type="submit" value="PRE-ORDER" />
            </form>
        </div>
        
    </div>
    
    <div class="product-foot">
        <div class="description-card">
            <p class="description" contenteditable="false">$description</p>
        </div>
    </div>
    
</div>
HTML;
    }

    public function present() {
        echo '<div id="product">';
        echo $this->nav();
        echo $this->product();
        echo '</div>';
        echo $this->footer();
    }
}