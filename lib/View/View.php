<?php


namespace View;

use Model\Site;
use Model\User;

class View {

    private $user;
    private $site;
    private $title;
    private $api_client;
    private $links = [];
    private $protectRedirect = null;

    public function __construct(Site $site, User $user = null, $api_client = null) {
        $this->site = $site;
        $this->user = $user;
        $this->api_client = $api_client;

        if($user) {
            if($user->isAdmin()) {
                $this->addLink("./admin.php", "Admin");
            }
            $this->addLink("./product.php?name=Cat Pack&id=19", "Pre-Order");
            $this->addLink("./contact-us.php", "Contact Us");
            $this->addLink("./orders.php", "Orders");
            $this->addLink("./cart.php", "Cart");
            $this->addLink("post/logout.php", "Log Out");
        } else {
            $this->addLink("./contact-us.php", "Contact Us");
            $this->addLink("./cart.php", "Cart");
            $this->addLink("./login.php", "Login");
        }
    }

    public function getUser() { return $this->user; }

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
        <li class="logo"><a href="./"><img src="dist/img/Logo.png"></a></li>
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

    public function getApiClient() { return $this->api_client; }

    public function footer() {
        return '<footer><p>Copyright © '.date('Y').' Pet Pack, LLC. All Rights Reserved.</p></footer>';
    }

    public function head() {
        return <<<HTML
<meta charset="utf-8">
<title>$this->title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/jpg" href="dist/img/Tab_Icon.jpg" />
<script src="dist/main.js"></script>
<script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform"></script>
HTML;
    }

}