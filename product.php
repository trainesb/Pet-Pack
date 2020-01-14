<?php
$open = true;
require 'lib/site.inc.php';
$view = new View\ProductView($site, $user);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->present(); ?>
</body>
</html>
