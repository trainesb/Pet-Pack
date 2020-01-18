import $ from 'jquery';
import {parse_json} from './parse_json';

export const EditProduct = function() {

    $("div.tabs ul li a").click(function (event) {
        event.preventDefault();

        let active = $("div.tabs ul li.active");
        active.removeClass('active');

        let child = active.children().attr("class");
        $("div."+child).attr("hidden", true);

        let newActive = $(this).attr("class");
        $("div."+newActive).attr("hidden", false);
        $(this).parent().addClass("active");
    });
};