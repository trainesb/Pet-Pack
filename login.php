<?php
$open = true;
require 'lib/site.inc.php';

$view = new View\Login($site, $user, $_COOKIE);
?>
<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>
<body>
<?php echo $view->nav(); ?>

<div id="login">
    <?php echo $view->present(); ?>
</div>

<?php echo $view->footer(); ?>
</body>
</html>