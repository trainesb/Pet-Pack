import $ from 'jquery';
import {parse_json} from './parse_json';

export const Register = function() {

    $('form#register').submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: 'post/register.php',
            data: $(this).serialize(),
            method: 'POST',
            success: function (data) {
                let json = parse_json(data);
                console.log('Success: ', json);
                if(json.ok) {
                    window.location.assign('./login.php');
                }
            },
            error: function (xhr, status, err) {
                console.error('Error: ');
                console.log(err);
            }
        });
    });

};