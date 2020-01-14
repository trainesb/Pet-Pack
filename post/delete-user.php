<?php
require '../lib/site.inc.php';

$controller = new Controller\DeleteUserController($site);
echo $controller->getResult();