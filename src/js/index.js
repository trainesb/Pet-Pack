import $ from 'jquery';

import '../scss/Style.scss';

import { Login } from "./Login";
import { Register } from "./Register";
import { Profile } from "./Profile";

$(document).ready(function () {
    new Login();
    new Register();
    new Profile();
});