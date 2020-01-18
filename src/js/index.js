import $ from 'jquery';

import '../scss/Style.scss';

import { Login } from "./Login";
import { Product } from "./Product";
import { Cart } from "./Cart";
import { Checkout } from "./Checkout";
import { Register } from "./Register";
import { AddProduct } from "./AddProduct";
import { EditProduct } from "./EditProduct";
import { Profile } from "./Profile";

$(document).ready(function () {
    new Login();
    new Product();
    new Cart();
    new Checkout();
    new Register();
    new AddProduct();
    new EditProduct();
    new Profile();
});