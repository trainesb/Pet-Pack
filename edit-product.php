<?php
require 'lib/site.inc.php';
$view = new View\EditProduct($site, $user, $api_client);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>
<body>
    <?php echo $view->nav() ?>
    <div id="edit-product">
        <?php echo $view->present(); ?>
    </div>
    <?php echo $view->footer() ?>
</body>
</html>
