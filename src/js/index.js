import $ from 'jquery';

import '../scss/Style.scss';

import { Login } from "./Login";
import { AdminNav } from "./AdminNav";
import { Members } from "./Members";
import { Product } from "./Product";
import { Cart } from "./Cart";

$(document).ready(function () {
    new Login();
    new AdminNav();
    new Members();
    new Product();
    new Cart();
});