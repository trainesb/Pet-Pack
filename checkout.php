<?php
$open = true;
require 'lib/site.inc.php';
$view = new View\CheckoutView($site, $user, $_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->present(); ?>

</body>
</html>