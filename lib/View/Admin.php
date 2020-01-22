<?php


namespace View;


class Admin extends View {

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Admin");

        if(!$this->protect($site, $user)) {
            header("location: " . $this->getProtectRedirect());
            exit;
        }
    }

    public function present() {
        echo '<div class="content">';
        echo $this->presentSales();
        echo $this->presentSessions();
        echo '</div>';
    }

    public function presentSales() {
        return <<<HTML
<div class="sales card">
    <h3>TODAY'S SALES</h3>
    <p>No sales yet</p>
    <hr>
    <p>No orders yet</p>
</div>
HTML;
    }

    public function presentSessions() {
        return <<<HTML
<div class="sessions card">
    <h3>TODAY'S SESSIONS</h3>
    <p>No sessions yet</p>
    <hr>
    <p>No visitors right now</p>
</div>
HTML;
    }
}