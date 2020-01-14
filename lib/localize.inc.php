<?php

return function (Model\Site $site) {

    // Set the time zone
    date_default_timezone_set('America/Detroit');
    $site->setEmail('trainesben68@gmail.com');
    $site->setRoot('/epetpack');
    $site->dbConfigure('mysql:host=localhost;dbname=epetpack','root','','');
};
