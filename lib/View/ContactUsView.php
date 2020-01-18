<?php


namespace View;


class ContactUsView extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Contact Us");
    }

    public function present() {
        echo $this->contactForm();
    }

    public function contactForm() {
        return <<<HTML
<div class="contact-wrapper">
    <form id="contact">
        <fieldset>
            <legend>Contact Us</legend>
            
            <p>
                <label for="name">Name: </label>
                <input type="text" name="name" placeholder="Name">
            </p>
            <p>
                <label for="email">Email: </label>
                <input type="email" name="email" placeholder="email">
            </p>
            <p>
                <label for="message">Message: </label>
                <input type="text" name="message" placeholder="Message...">
            </p>
            <p><input type="submit" value="Submit"></p>
        </fieldset>
    </form>
</div>
HTML;
    }

}