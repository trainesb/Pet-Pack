<?php
require '../lib/site.inc.php';

$controller = new Controller\AddProductController($site, $user, $api_client);
echo $controller->getResult();