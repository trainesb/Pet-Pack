<?php
require '../lib/site.inc.php';

$controller = new Controller\CheckoutController($site);
echo $controller->getResult();