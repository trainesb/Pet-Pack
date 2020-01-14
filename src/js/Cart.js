import $ from 'jquery';
import {parse_json} from './parse_json';

export const Cart = function() {

    $("div#cart p.qty input").change(function (event) {
        event.preventDefault();

        let qty = $(this).val();
        let id = $(this).attr('id');
        let name = $(this).parent().prev().prev().text();

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
                    console.log("Updated");
                    window.location.reload();
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