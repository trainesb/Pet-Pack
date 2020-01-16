<?php
require '../lib/site.inc.php';

$controller = new Controller\CreateCatalogItemController($site, $api_client);
echo $controller->getResult();