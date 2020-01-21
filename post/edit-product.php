<?php
require '../lib/site.inc.php';

$controller = new Controller\EditProductController($site, $user, $api_client);
echo $controller->getResult();