import $ from 'jquery';
import {parse_json} from "./parse_json";

export const CreateCatalogItem = function() {

    $("form#create-catalog-item").submit(function (event) {
        event.preventDefault();

        $.ajax({
           url: "post/create-catalog-item.php",
           data: $(this).serialize(),
           type: "POST",
           success: function (data) {
               console.log(JSON.stringify(data));
           },
           error: function (xhr, status, error) {
               console.log(error);
           }
        });
    });
};