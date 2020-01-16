<?php
$open = true;  // Dont have to be signed in to access
require 'lib/site.inc.php';
$view = new View\MembersView($site, $user);

?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>
<body>
<?php echo $view->present(); ?>
</body>
</html>
