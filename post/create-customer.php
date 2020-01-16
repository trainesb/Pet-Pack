<?php
$open = true;
require '../lib/site.inc.php';

$controller = new Controller\CreateCustomerController($site);
echo $controller->getResult();