<?php
require 'lib/site.inc.php';
$view = new View\CheckoutView($site, $user, $_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>
<body id="checkout">
<?php echo $view->present(); ?>

<?php echo $view->footer(); ?>
</body>
</html>
