<?php


namespace View;


use Model\Site;
use Model\User;

class AddProduct extends View {

    public function __construct(Site $site, User $user = null) {
        parent::__construct($site, $user);
        $this->setTitle('Add Product');
    }

    public function present() {
        echo $this->addProduct();
    }

    public function addProduct() {
        return <<<HTML
<form id="add-product">
    <p>
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" placeholder="Name">
    </p>
    <p>
        <label for="caption">Caption: </label>
        <input type="text" id="caption" name="caption" placeholder="Caption">
    </p>
    <p>
        <label for="description">Description: </label>
        <input type="text" id="description" name="description" placeholder="Description">
    </p>
    <p>
        <label for="active">Is Available: </label>
        <input type="checkbox" id="active" name="active">
    </p>    
    <p>
        <label for="shippable">Is Shippable: </label>
        <input type="checkbox" id="shippable" name="shippable">
    </p>
    <p><input type="submit" value="Submit"></p>
</form>
HTML;
    }
}