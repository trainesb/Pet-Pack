import $ from 'jquery';
import {parse_json} from './parse_json';

export const Register = function() {

    // Checks that both passwords match
    $("input#password2").change(function (event) {
        event.preventDefault();

        let password = $("input#password").val();
        let password2 = $(this).val();
        if(password != password2) {
            console.log("Passwords don't match!");
        }
    });

    $("form#create-customer").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: 'post/register.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data) {
                let json = parse_json(data);
                if (json.ok) {
                    window.location.assign('./');
                } else {
                    console.log(json.message);
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
};