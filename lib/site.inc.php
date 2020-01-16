<?php
require __DIR__ . "/../vendor/autoload.php";

define("LOGIN_COOKIE", "epetpack_cookie");

$site = new Model\Site();
$cart = new Model\Cart();
$localize = require 'localize.inc.php';

if(is_callable($localize)) {
    $localize($site);
}

// Start the session system
session_start();
$user = null;
if(isset($_SESSION[Model\User::SESSION_NAME])) {
    $user = $_SESSION[Model\User::SESSION_NAME];
}

if(empty($_SESSION["cart"])) {
    $_SESSION["cart"] = $cart;
};

if(!isset($open) || !$open) {
    // This is a page other than the login pages
    if (!isset($_SESSION[Model\User::SESSION_NAME])) {


        // We have a valid cookie
        $cookies = new API\CookieTable($site);
        $val = $cookies->validate(LOGIN_COOKIE['user'], LOGIN_COOKIE['token']);
        if($val != null) {
            $user = LOGIN_COOKIE['user'];
            // It's valid, we can log in!
            $_SESSION[Model\User::SESSION_NAME] = array("user" => $user);
        } else {
            // If not logged in, force to the login page
            $root = $site->getRoot();
            header("location: $root/login.php");
            exit;
        }
    } else {
        // We are logged in.
        $user = $_SESSION[Model\User::SESSION_NAME];
    }
}
