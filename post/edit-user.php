<?php
require '../lib/site.inc.php';

$controller = new Controller\UserController($site, $user, 'U');
echo $controller->getResult();