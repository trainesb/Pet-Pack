import $ from 'jquery';

import '../scss/Style.scss';

import { Login } from "./Login";
import { Register } from "./Register";

$(document).ready(function () {
    new Login();
    new Register()
});