import $ from 'jquery';
import {parse_json} from './parse_json';

export const Profile = function() {

    $("div#profile div.customer p.edit-profile button").click(function (event) {
        event.preventDefault();

        if($(this).text() === "Edit") {
            $(this).text("Finish Editing");
            $("div.customer p.nickname").attr("contenteditable", true);
            $("div.customer p.givenName").attr("contenteditable", true);
            $("div.customer p.familyName").attr("contenteditable", true);
            $("div.customer p.email").attr("contenteditable", true);
            $("div.customer p.phone").attr("contenteditable", true);
            $("div.customer p.birthday").attr("contenteditable", true);
            $("div.customer p.note").attr("contenteditable", true);

            $("div.address-wrapper p.address1").attr("contenteditable", true);
            $("div.address-wrapper p.address2").attr("contenteditable", true);
            $("div.address-wrapper p.state").attr("contenteditable", true);
            $("div.address-wrapper p.city").attr("contenteditable", true);
            $("div.address-wrapper p.postal_code").attr("contenteditable", true);
        } else {
            $(this).text("Edit");
            let nickname = $("div.customer p.nickname").text();
            let givenName = $("div.customer p.givenName").text();
            let familyName = $("div.customer p.familyName").text();
            let email = $("div.customer p.email").text();
            let phone = $("div.customer p.phone").text();
            let birthday = $("div.customer p.birthday").text();
            let note = $("div.customer p.note").text();
            let customerId = $("div.customer p.id span").text();

            let address1 = $("div.address-wrapper p.address1").text();
            let address2 = $("div.address-wrapper p.address2").text();
            let state = $("div.address-wrapper p.state").text();
            let city = $("div.address-wrapper p.city").text();
            let postalCode = $("div.address-wrapper p.postal_code").text();

            let msg = "Change Profile\nNickname = "+nickname+"\nGiven Name = "+givenName+"\nFamily Name = "+familyName+"\nEmail = "+email+"\nPhone = "+phone+"\nBirthday = "+birthday+"\nNote = "+note+"\n";
            msg += "\nChange Address\nAddress1 = "+address1+"\nAddress2 = "+address2+"\nState = "+state+"\nCity = "+city+"\nPostal Code = "+postalCode+"\n";

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
                        note: note,
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
                        window.location.reload();
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