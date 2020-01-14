<?php
require 'lib/site.inc.php';
$view = new View\ProfileView($site, $user);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->present(); ?>
</body>
</html>
