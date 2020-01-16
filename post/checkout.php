<?php
require '../lib/site.inc.php';

$controller = new Controller\CheckoutController($site, $api_client, $user);
echo $controller->getResult();