import $ from 'jquery';
import {parse_json} from './parse_json';

export const Checkout = function() {

    $("div#checkout button.submit-checkout").click(function(event) {
        event.preventDefault();

        if(confirm("Submit Payment?")) {
            let userId = $("div#checkout").attr("class");
            let shippingId = $("div.address").attr("id");
            let cardId = $("div.payment").attr("id");
            let productId = $("div.product-info div.product").attr("id");
            let qty = $("div.product-info div.product p.qty").text().substr(0, 5);
            let total = $("span#totalCost").text();
            let date = new Date();

            $.ajax({
                url: "post/checkout.php",
                data: {
                    userId: userId,
                    shippingId: shippingId,
                    cardId: cardId,
                    productId: productId,
                    qty: qty,
                    total: total,
                    date: date
                },
                method: "POST",
                success: function(data) {
                    let json = parse_json(data);
                    if(json.ok) {
                        window.location.assign('./order.php');
                    } else {
                        alert(json.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error);
                }
            });
        }
    });
};