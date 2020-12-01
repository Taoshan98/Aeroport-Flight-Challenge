$(document).on('click', "#submit", function( event ) {

    $.ajax({
        method: "POST",
        url: "ajax/action.php",
        dataType: "json",
        data: { departure: $("#departure").val(), arrival: $("#arrival").val() },
        success: function (res){

            let response = '<div class="alert alert-warning" role="alert" >' + res['text'] + '</div>';

            if (res['stops'] !== undefined){

                response = '<div class="alert alert-success" role="alert" >'
                                + res['text'] + '<br>';

                $.each(res['stops'], function(i, item) {
                    response += '- ' + item + '<br>';
                });

                response += "</div>"
            }

            $("#showResponse").html(response);
        },
    });

    event.preventDefault();
});
