<?php
require '../lib/site.inc.php';

$controller = new Controller\ProductController($site, 'A');
echo $controller->getResult();