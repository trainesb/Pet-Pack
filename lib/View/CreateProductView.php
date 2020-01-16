<?php


namespace View;


use View\Form\CreateCatalogItem;

class CreateProductView extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Create A Product");

        if(!$this->protect($site, $user)) {
            header("location: " . $this->getProtectRedirect());
            exit;
        }
    }

    public function present() {
        echo $this->head();

        echo '<div id="createProduct">';
        echo $this->nav();
        echo $this->createCatalogItem();
        echo '</div>';
        echo $this->footer();
    }

    public function createCatalogItem() {
        $catalogItem = new CreateCatalogItem();
        return $catalogItem->present();
    }

    public function productForm() {
        return <<<HTML
<form id="create-product">
    <fieldset>
        <legend>Creat A Product</legend>
        
        <p>
            <label for="name">Name: </label>
            <input type="text" name="name" placeholder="Product Name"/>
        </p>
        <p>
            <label for="sku">SKU: </label>
            <input type="text" name="sku" placeholder="SKU" />  
        </p>
        <p>
            <label for="productImg">Product Image: </label>
            <input type="file" name="productImg" placeholder="Product Image" />
        </p>
        <p>
            <label for="shortDescription">Short Description: </label>
            <input type="text" name="shortDescription" placeholder="Short Description..." />
        </p>
        <p>
            <label for="regularPrice">Regular Price: </label>
            <input type="number" name="regularPrice" value="0.00" />
        </p>
        <p>
            <label for="salePrice">Sale Price: </label>
            <input type="number" name="salePrice" value="0.00" />
        </p>
        <p>
            <label for="qty">Quantity: </label>
            <input type="number" name="qty" value="0" />
        </p>
        <p>
            <label for="soldOut">Sold-Out: </label>
            <input type="checkbox" name="soldOut" />
        </p>
        <p>
            <label for="description">Description: </label>
            <input type="text" name="description" placeholder="Description..." />
        </p>
        <p>
            <label for="gallery">Gallery: </label>
            <input type="file" name="gallery" placeholder="Gallery" />
        </p>
        <p>
            <label for="weight">Weight: </label>
            <input type="number" name="weight" value="0.0"/>
        </p>
        <p>
            <label for="height">Height: </label>
            <input type="number" name="height" value="0.0"/>
        </p>
        <p>
            <label for="length">Length: </label>
            <input type="number" name="length" value="0.0"/>
        </p>
        <p>
            <label for="width">Width: </label>
            <input type="number" name="width" value="0.0"/>
        </p>
        <p><input type="submit" value="Submit"></p>
    </fieldset>
</form>
HTML;
    }
}