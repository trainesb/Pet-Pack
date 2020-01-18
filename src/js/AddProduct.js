import $ from 'jquery';
import {parse_json} from './parse_json';

export const AddProduct = function() {

    $("form#item-form").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/add-product.php",
            data: $(this).serialize(),
            method: "POST",
            success: function(data) {
                let json = parse_json(data);
                if(json.ok) {
                    window.location.assign("./admin.php");
                } else {
                    alert(json.message);
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    });
};