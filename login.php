<?php
$open = true;
require 'lib/site.inc.php';

$view = new View\LoginView($site, $user, $_COOKIE);
?>
<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>

<body>
<?php echo $view->present(); ?>

</body>
</html>