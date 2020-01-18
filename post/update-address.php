<?php
require '../lib/site.inc.php';

$controller = new Controller\UpdateAddressController($site, $user, $api_client);
echo $controller->getResult();