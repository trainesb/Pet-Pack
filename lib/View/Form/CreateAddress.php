<?php


namespace View\Form;


class CreateAddress {

    public function present() {
        return <<<HTML
<form id="add-address">
    <fieldset>
        <legend>Add Address</legend>
        
        <p>
        <label for="first-name">First Name: </label>
        <input type="text" id="first-name" name="first-name" placeholder="First Name">    
        </p>
        
        <p>
        <label for="last-name">Last Name: </label>
        <input type="text" id="last-name" name="last-name" placeholder="Last Name">    
        </p>
        
        <p>
        <label for="address1">Address1: </label>
        <input type="text" id="address1" name="address1" placeholder="address1">    
        </p>
        
        <p>
        <label for="address2">Address2: </label>
        <input type="text" id="address2" name="address2" placeholder="address2">    
        </p>
        
        <p>
        <label for="country">Country: </label>
        <input type="text" id="country" name="country" placeholder="Country">    
        </p>
        
        <p>
        <label for="state">State: </label>
        <input type="text" id="state" name="state" placeholder="State">    
        </p>
        
        <p>
        <label for="city">City: </label>
        <input type="text" id="city" name="city" placeholder="city">    
        </p>
        
        <p>
        <label for="zip">Zip: </label>
        <input type="text" id="zip" name="zip" placeholder="zip">    
        </p>
        
        <p><input type="submit" value="Submit"></p>      
    </fieldset>
</form>
HTML;
    }
}