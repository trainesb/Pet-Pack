<?php


namespace View\Form;


class CreateCatalogItem {

    public function present() {
        return <<<HTML
<form id="create-catalog-item">
    <fieldset>
        <legend>Create Catalog Item</legend>
        
        <p>
            <label for="name">Name: </label>
            <input type="text" id="name" name="name" placeholder="Product Name">
        </p>
        
        <p>
            <label for="description">Description: </label>
            <textarea id="description" name="description" placeholder="Description..."></textarea>
        </p>
        
        <p><input type="submit" value="Submit"></p>
        
    </fieldset>
</form>
HTML;
    }
}