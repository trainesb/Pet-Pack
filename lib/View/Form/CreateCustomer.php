<?php


namespace View\Form;


class CreateCustomer {

    public function present() {
        return <<<HTML
<form id="create-customer">
    <fieldset>
        <legend>Create Customer</legend>
        
        <p>
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" placeholder="Username">    
        </p>
        
        <p>
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" placeholder="Email">   
        </p>
        
        <p>
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" placeholder="Password">   
        </p>
        
        <p>
        <label for="password2">Confirm Password: </label>
        <input type="password" id="password2" name="password2" placeholder="Confirm Password">   
        </p>
        
        <p><input type="submit" value="Submit"></p>
    </fieldset>
</form>
HTML;
    }
}