<?php
$open = true;
require 'lib/site.inc.php';
$view = new View\Register($site, $user);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>
<body>
<?php echo $view->nav(); ?>

<div id="register">
    <?php echo $view->present(); ?>
</div>

<?php echo $view->footer(); ?>
</body>
</html>
