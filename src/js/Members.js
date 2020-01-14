import $ from 'jquery';
import {parse_json} from "./parse_json";

export const Members = function() {

    $("div.user-card button.delete-user").click(function(event) {
        event.preventDefault();

        let username = $(this).next().text();
        if(confirm("Delete User: " + username)) {
            $.ajax({
                url: "post/delete-user.php",
                data: {id: $(this).attr("id")},
                type: "POST",
                success: function(data) {
                    let json = parse_json(data);
                    if(json.ok) {
                        window.location.reload();
                    } else {
                        alert(json.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
        }
    });
};