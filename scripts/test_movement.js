function firstButton() {
    $('button').each(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-warning');
            let articles_html = $.post("change_movement.php", {call_now: "True"});
            console.log(articles_html);
            let container = $('#container');
            articles_html.done(function (data) {
                container.empty();
                container.append(data.html);
            })
        }
    });
}

function show_table() {
    $('.btn').on('click', function(){
        $('#movement_table').show();
        //$('input.btn-warning').addClass('btn-primary');
        //$('input.btn-warning').removeClass('btn-warning');
        //$(this).removeClass('btn-primary');
        //$(this).addClass('btn-warning');
    });
}

$(function() {
    //firstButton();
    show_table();
});