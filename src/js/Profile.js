import $ from 'jquery';
import {parse_json} from './parse_json';

export const Profile = function() {
    $("form#create-address").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: 'post/create-address.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data) {
                data = parse_json(data);
                console.log(data);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
};