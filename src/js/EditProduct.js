import $ from 'jquery';
import {parse_json} from './parse_json';

export const EditProduct = function() {

    $("div.tabs ul li a").click(function (event) {
        event.preventDefault();

        let active = $("div.tabs ul li.active");
        active.removeClass('active');

        let child = active.children().attr("class");
        $("div."+child).attr("hidden", true);

        let newActive = $(this).attr("class");
        $("div."+newActive).attr("hidden", false);
        $(this).parent().addClass("active");
    });

    $('#product-image:file').on('change', function () {
        let file = this.files[0];

        if(file.size > 10000000) {
            alert('Max upload size is 10000k');
        }
    });

    $("form#productImage").submit(function (event) {
        event.preventDefault();
        let formData = new FormData();

        formData.append('caption', $('#caption').val());
        formData.append('name', $('#name').val());
        formData.append('productImage', $('#product-image')[0].files[0]);
        formData.append('type', 'IMAGE');
        formData.append('productId', $(this).attr('class'));
        formData.append('version', $(this).attr('version'));

        console.log(formData);

        $.ajax({
            url: "post/edit-product.php",
            enctype: "multipart/form-data",
            data: formData,
            contentType: false,
            processData: false,
            type: "POST",
            success: function (data) {
                let json = parse_json(data);
                console.log(json);
                if(json.ok) {
                    console.log("success");
                }
            },
            error: function (xhr, status, err) {
                console.error(err);
                console.log("error");
            }
        })
    });
};