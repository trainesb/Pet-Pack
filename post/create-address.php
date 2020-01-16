<?php
require '../lib/site.inc.php';

$controller = new Controller\CreateAddressController($site);
echo $controller->getResult();