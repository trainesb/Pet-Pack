import $ from 'jquery';
import {parse_json} from './parse_json';

export const Profile = function() {

    $("div#profile div.customer p.edit-profile button").click(function (event) {
        event.preventDefault();

        if($(this).text() === "Edit") {
            $(this).text("Finish Editing");
            $("div.customer p.nickname span").attr("contenteditable", true);
            $("div.customer p.givenName span").attr("contenteditable", true);
            $("div.customer p.familyName span").attr("contenteditable", true);
            $("div.customer p.email span").attr("contenteditable", true);
            $("div.customer p.phone span").attr("contenteditable", true);
            $("div.customer p.birthday span").attr("contenteditable", true);
            $("div.customer p.note span").attr("contenteditable", true);
        } else {
            $(this).text("Edit");
            let nickname = $("div.customer p.nickname span").text();
            let givenName = $("div.customer p.givenName span").text();
            let familyName = $("div.customer p.familyName span").text();
            let email = $("div.customer p.email span").text();
            let phone = $("div.customer p.phone span").text();
            let birthday = $("div.customer p.birthday span").text();
            let note = $("div.customer p.note span").text();
            let customerId = $("div.customer p.id span").text();

            let msg = "Change Profile\nNickname = "+nickname+"\nGiven Name = "+givenName+"\nFamily Name = "+familyName+"\nEmail = "+email+"\nPhone = "+phone+"\nBirthday = "+birthday+"\nNote = "+note+"\n";
            if(confirm(msg)) {
                $.ajax({
                    url: 'post/update-profile.php',
                    data: {
                        customerId: customerId,
                        nickname: nickname,
                        givenName: givenName,
                        familyName: familyName,
                        email: email,
                        phone: phone,
                        birthday: birthday,
                        note: note
                    },
                    type: "POST",
                    success: function (data) {
                        console.log("success");
                        console.log(data);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            } else {
                window.location.reload();
            }
        }
    });

    $("div#profile div.address-wrapper p.edit-address button").click(function(event) {
        event.preventDefault();

        if($(this).text() === "Edit") {
            $(this).text("Finish Editing");
            $("div.address-wrapper p.first_name span").attr("contenteditable", true);
            $("div.address-wrapper p.last_name span").attr("contenteditable", true);
            $("div.address-wrapper p.address1 span").attr("contenteditable", true);
            $("div.address-wrapper p.address2 span").attr("contenteditable", true);
            $("div.address-wrapper p.state span").attr("contenteditable", true);
            $("div.address-wrapper p.city span").attr("contenteditable", true);
            $("div.address-wrapper p.postal_code span").attr("contenteditable", true);
        } else {
            $(this).text("Edit");
            let firstName = $("div.address-wrapper p.first_name span").text();
            let lastName = $("div.address-wrapper p.last_name span").text();
            let address1 = $("div.address-wrapper p.address1 span").text();
            let address2 = $("div.address-wrapper p.address2 span").text();
            let state = $("div.address-wrapper p.state span").text();
            let city = $("div.address-wrapper p.city span").text();
            let postalCode = $("div.address-wrapper p.postal_code span").text();
            let customerId = $("div.address-wrapper").attr("id");

            let msg = "Change Address\nFirst Name = "+firstName+"\nLast Name = "+lastName+"\nAddress1 = "+address1+"\nAddress2 = "+address2+"\nState = "+state+"\nCity = "+city+"\nPostal Code = "+postalCode+"\n";
            if(confirm(msg)) {
                $.ajax({
                    url: 'post/update-address.php',
                    data: {
                        customerId: customerId,
                        firstName: firstName,
                        lastName: lastName,
                        address1: address1,
                        address2: address2,
                        state: state,
                        city: city,
                        postalCode: postalCode
                    },
                    type: "POST",
                    success: function (data) {
                        console.log("success");
                        console.log(data);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            } else {
                window.location.reload();
            }
        }
    });
};