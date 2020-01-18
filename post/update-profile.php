<?php
require '../lib/site.inc.php';

$controller = new Controller\UpdateProfileController($site, $user, $api_client);
echo $controller->getResult();