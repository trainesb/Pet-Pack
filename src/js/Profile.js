import $ from 'jquery';
import {parse_json} from './parse_json';

export const Profile = function() {
    $("button#add-paymentCard").click(function() {
        let text = $(this).text();
        if(text != "Cancel") {
            $(this).text("Cancel");
            $("div.add-paymentCard").css("display", "block");
            $("div.paymentCard-card").css("display", "none");
        } else {
            $(this).text("Add Payment Card");
            $("div.add-paymentCard").css("display", "none");
            $("div.paymentCard-card").css("display", "block");
        }
    });

    $("form#add-payment").submit(function (event) {
        event.preventDefault();

        let americanExpress = /^(?:3[47][0-9]{13})$/;
        let visa = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
        let masterCard = /^(?:5[1-5][0-9]{14})$/;
        let discoverCard = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/;
        let dinersClubCard = /^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$/;
        let jcb = /^(?:(?:2131|1800|35\d{3})\d{11})$/;

        let userId = $(this).attr('class');
        let alias = $("input[name=alias]").text();
        let fullName = $("input[name=fullName]").text();
        let cardNumber = $("input[name=cardNumber]").val();
        let vcc = $("input[name=vcc]").val();
        let zip = $("input[name=zip]").val();

        $.ajax({
            url: "post/add-payment.php",
            data: {
                userId: userId,
                alias: alias,
                fullName: fullName,
                cardNumber: cardNumber,
                vcc: vcc,
                zip: zip
            },
            method: "POST",
            success: function(data) {
                let json = parse_json(data);
                if(json.ok) {
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

    $("button#add-address").click(function() {
        let text = $(this).text();
        if(text != "Cancel") {
            $(this).text("Cancel");
            $("div.add-address").css("display", "block");
            $("div.address-card").css("display", "none");
        } else {
            $(this).text("Add Address");
            $("div.add-address").css("display", "none");
            $("div.address-card").css("display", "block");
        }
    });

    $("form#add-address").submit(function (event) {
        event.preventDefault();

        let userId = $(this).attr('class');
        let firstName = $("input[name=firstName]").text();
        let lastName = $("input[name=lastname]").text();
        let address1 = $("input[name=address1]").text();
        let address2 = $("input[name=address2]").text();
        let city = $("input[name=city]").text();
        let state = $("input[name=state]").text();
        let zip = $("input[name=zip]").val();

        $.ajax({
            url: "post/add-address.php",
            data: {
                userId: userId,
                firstName: firstName,
                lastName: lastName,
                address1: address1,
                address2: address2,
                city: city,
                state: state,
                zip: zip
            },
            method: "POST",
            success: function(data) {
                let json = parse_json(data);
                if(json.ok) {
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