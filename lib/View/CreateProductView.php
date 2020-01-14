<?php


namespace View;


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
        echo $this->productForm();
        echo '</div>';
        echo $this->footer();
    }

    public function productForm() {
        return <<<HTML
<form id="create-product">
    <fieldset>
        <legend>Creat A Product</legend>
        
        <label for="name">Name: </label>
        <input type="text" name="name" placeholder="Product Name"/>
      
        <label for="sku">SKU: </label>
        <input type="text" name="sku" placeholder="SKU" />  
     
        <label for="productImg">Product Image: </label>
        <input type="file" name="productImg" placeholder="Product Image" />
      
        <label for="shortDescription">Short Description: </label>
        <input type="text" name="shortDescription" placeholder="Short Description..." />
       
        <label for="regularPrice">Regular Price: </label>
        <input type="number" name="regularPrice" value="0.00" />
        
        <label for="salePrice">Sale Price: </label>
        <input type="number" name="salePrice" value="0.00" />
        
        <label for="qty">Quantity: </label>
        <input type="number" name="qty" value="0" />
        
        <label for="soldOut">Sold-Out: </label>
        <input type="checkbox" name="soldOut" />
        
        <label for="description">Description: </label>
        <input type="text" name="description" placeholder="Description..." />
        
        <label for="gallery">Gallery: </label>
        <input type="file" name="gallery" placeholder="Gallery" />
    
        <label for="weight">Weight: </label>
        <input type="number" name="weight" value="0.0"/>
        
        <label for="height">Height: </label>
        <input type="number" name="height" value="0.0"/>
        
        <label for="length">Length: </label>
        <input type="number" name="length" value="0.0"/>
        
        <label for="width">Width: </label>
        <input type="number" name="width" value="0.0"/>
        
        <input type="submit" value="Submit">
    </fieldset>
</form>
HTML;
    }
}