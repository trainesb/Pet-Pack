<?php
require '../lib/site.inc.php';

$controller = new Controller\AddAddressController($site);
echo $controller->getResult();