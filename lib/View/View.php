<?php


namespace View;

use Model\Site;
use Model\User;

class View {

    private $user;
    private $site;
    private $title;
    private $links = [];
    private $protectRedirect = null;

    public function __construct(Site $site, User $user = null) {
        $this->site = $site;
        $this->user = $user;

        if($user) {
            if($user->isAdmin()) {
                $this->addLink("./admin.php", "Admin");
            }
            $this->addLink("./product.php?name=Cat Pack&id=19", "Pre-Order");
            $this->addLink("./contact-us.php", "Contact Us");
            $this->addLink("./profile.php", "Profile");
            $this->addLink("./cart.php", "Cart");
            $this->addLink("post/logout.php", "Log Out");
        } else {
            $this->addLink("./contact-us.php", "Contact Us");
            $this->addLink("./cart.php", "Cart");
            $this->addLink("./login.php", "Login");
        }
    }

    public function getUser() { return $this->user; }

    public function adminNav() {
        return <<< HTML
<nav class="adminNav">
    <ul class="admin-links">
        <li><a href="./members.php">Members</a></li>
        <li><a href="./products.php">Products</a></li>
        <li><a href="./create-product.php">Add A Product</a></li>
    </ul>
</nav>
HTML;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function protect($site, $user) {
        if($user->isAdmin()) { return true; }
        $this->protectRedirect = $site->getRoot() . "/";
        return false;
    }

    public function addLink($href, $text) {
        $this->links[] = ["href" => $href, "text" => $text];
    }

    public function nav() {

        $html = <<<HTML
<nav class="topNav">
    <ul class="left">
        <li><a href="./">Pet Pack</a></li>
    </ul>
    <ul class="right">
HTML;

        if(count($this->links) > 0) {

            foreach($this->links as $link) {
                if($link["text"] === "Admin") {
                    $html .= '<li><a class="admin-link" href="' . $link['href'] . '">' . $link['text'] . '</a></li>';
                } else {
                    $html .= '<li><a href="' . $link['href'] . '">' . $link['text'] . '</a></li>';
                }
            }
        }

        $html .= '</ul></nav>';

        if(($this->user) && $this->user->isAdmin()) { $html .= $this->adminNav(); }
        return $html;
    }

    public function getProtectRedirect() {
        return $this->protectRedirect;
    }

    public function footer() {
        return '<footer><p>Copyright © '.date('Y').' Pet Pack, LLC. All Rights Reserved.</p></footer>';
    }

    public function head() {
        return <<<HTML
<meta charset="utf-8">
<title>$this->title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="dist/main.js"></script>
HTML;
    }

}