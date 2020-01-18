<?php


namespace View;


use Model\Site;
use Model\User;

class Admin extends View {

    public function __construct(Site $site, User $user = null, $api_client = null) {
        parent::__construct($site, $user, $api_client);

        if(!$user->isAdmin()) {
            header("location: ". $this->getProtectRedirect());
        }
        $this->setTitle("Admin");
    }

    public function present() {
        echo "<h1>Admin</h1>";
        echo $this->adminNav();
    }

    public function adminNav() {
        return <<<HTML
<nav id='adminNav'>
    <ul>
        <li><a href="./add-product.php">Add a Product</a></li>
        <li><a href="">Members</a></li>
        <li><a href="./products.php">Products</a></li>
    </ul>
</nav>
HTML;
    }

}