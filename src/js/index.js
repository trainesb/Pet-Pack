import $ from 'jquery';

import '../scss/Style.scss';

import { Login } from "./Login";
import { AdminNav } from "./AdminNav";
import { Members } from "./Members";

$(document).ready(function () {
    new Login();
    new AdminNav();
    new Members();
});