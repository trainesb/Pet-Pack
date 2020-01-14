<?php
require 'lib/site.inc.php';
$view = new View\CreateProductView($site, $user);
?>

<!DOCTYPE html>
<html lang="en">
<?php $view->present(); ?>

</body>
</html>
