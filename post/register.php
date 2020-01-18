<?php
$open = true;
require '../lib/site.inc.php';

$controller = new Controller\RegisterController($site);
echo $controller->getResult();