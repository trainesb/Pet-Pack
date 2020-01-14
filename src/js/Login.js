import $ from 'jquery';
import {parse_json} from './parse_json';

export const Login = function() {

    $("#loginForm").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/login.php",
            data: $(this).serialize(),
            method: "POST",
            success: function(data) {
                let json = parse_json(data);
                if(json.ok) {
                    window.location.assign('./');
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