import $ from 'jquery';

export const AdminNav = function() {

    $("nav.topNav ul li a.admin-link").hover(function () {
        $("nav.adminNav").css("display", "block");
    });

    $("nav.adminNav").mouseleave(function() {
        $("nav.adminNav").css("display", "none");
    });
};