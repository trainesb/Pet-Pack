<?php


namespace View\Form;


class CreateProduct {

    public function present() {
        echo $this->presentItem();
    }

    public function presentItem() {
        return <<<HTML
<div class="item-data">
    <form id="item-form">
        <fieldset>
            <legend>Item Data</legend>
            
            <p>
                <label for="abbreviation">Abbreviation: </label>
                <input type="text" id="abbreviation" name="abbreviation" placeholder="Abbreviation">
            </p>
            
            <p>
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Description..."></textarea>
            </p>
            
            <p>
                <label for="name">Name: </label>
                <input type="text" id="name" name="name" placeholder="Name">
            </p>
            
            <p><input type="submit" value="Submit"></p>
        </fieldset>
    </form>
</div>
HTML;
    }
}