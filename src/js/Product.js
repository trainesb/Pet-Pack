import $ from 'jquery';
import {parse_json} from './parse_json';

export const Product = function() {

    $("form#product-order").submit(function (event) {
        event.preventDefault();

        let name = $("div.product-head h1.name").text();
        let qty = $(this).serialize();
        let id = $("div.product-wrapper").attr('id');

        $.ajax({
            url: "post/product.php",
            data: {
                name: name,
                qty: qty,
                id: id
            },
            method: "POST",
            success: function(data) {
                let json = parse_json(data);
                if(json.ok) {
                    window.location.assign("./cart.php");
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