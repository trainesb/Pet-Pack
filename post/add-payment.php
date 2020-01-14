<?php
require '../lib/site.inc.php';

$controller = new Controller\AddPaymentController($site);
echo $controller->getResult();