<?php
require 'lib/site.inc.php';
$view = new View\OrdersView($site, $user, $api_client);

?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>
<body>
<?php echo $view->present(); ?>
</body>
</html>
