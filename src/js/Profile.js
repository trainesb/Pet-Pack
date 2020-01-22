import $ from 'jquery';
import {parse_json} from './parse_json';

export const Profile = function() {

    // User Functions
    $('button#edit-user').click(function (event) {
       event.preventDefault();

       $(this).parent().attr('hidden', true);
       $('form#edit-user-card').attr('hidden', false);

    });

    $('button#cancel-user-edit').click(function (event) {
        event.preventDefault();

        $(this).parent().attr('hidden', true);
        $('div.user-card').attr('hidden', false);
    });

    $('form#edit-user-card, form#edit-address-card').submit(function (event) {
       event.preventDefault();

       $.ajax({
           url: 'post/edit-user.php',
           data: $(this).serialize(),
           method: 'POST',
           success: function (data) {
               let json = parse_json(data);
               console.log('Success');
               console.log(json);
               if(json.ok) {
                   window.location.reload();
               }
           },
           error: function (xhr, status, err) {
               console.log('Error');
               console.log(err);
           }
       })
    });


    // Address Functions
    $('button#edit-address').click(function (event) {
       event.preventDefault();

       $(this).parent().attr('hidden', true);
       $('form#edit-address-card').attr('hidden', false);

    });

    $('button#cancel-address-edit').click(function (event) {
        event.preventDefault();

        $(this).parent().attr('hidden', true);
        $('div.address-card').attr('hidden', false);
    });

};