<?php
require 'lib/site.inc.php';
$view = new View\ProfileView($site, $user, $api_client);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->present(); ?>
</body>
</html>
