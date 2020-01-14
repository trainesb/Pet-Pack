<?php
require '../lib/site.inc.php';

$controller = new Controller\DeleteProductController($site);
echo $controller->getResult();