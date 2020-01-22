<?php
$open = true;
require 'lib/site.inc.php';
$view = new View\Home($site, $user);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>
<body>
    <?php echo $view->nav(); ?>

    <div class="home">

    </div>

    <?php echo $view->footer(); ?>
</body>
</html>
