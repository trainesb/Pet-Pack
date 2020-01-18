import $ from 'jquery';

import '../scss/Style.scss';

import { Login } from "./Login";
import { Product } from "./Product";
import { Cart } from "./Cart";
import { Checkout } from "./Checkout";
import { Register } from "./Register";

$(document).ready(function () {
    new Login();
    new Product();
    new Cart();
    new Checkout();
    new Register();
});