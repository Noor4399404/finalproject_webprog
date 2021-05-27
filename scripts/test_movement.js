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

function edit_table() {
    let button = $.post("./test_movement.php", {call_now: "True"});
    $('.btn').click(function() {
        $('.btn-warning').addClass('btn-primary');
        $('.btn-warning').removeClass('btn-warning');
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-warning');
        let active_button = $(this).attr('id');
        $('#movement_table').show();
        $.getJSON("data/possible_moves.json", function(data){
            $.each(data, function(key,value) {
                if (active_button === key) {
                    let table_row = $('tr')[1];
                    let tax_moves = data[key]['tax'];
                    if (tax_moves === " ") {
                        tax_moves = "No moves!";
                    }
                    let bus_moves = data[key]['bus'];
                    if (bus_moves === " ") {
                        bus_moves = "No moves!";
                    }
                    let und_moves = data[key]['und'];
                    if (und_moves === " ") {
                        und_moves = "No moves!";
                    }
                    table_row.innerHTML = '<td>' + tax_moves + '</td><td>' + bus_moves + '</td><td>' + und_moves + '</td>';
                }
            })
            $.each(data, function(key,value) {
                $('.btn-primary').each(function(button) {
                    let tax_moves = data[key]['tax'];
                    $.each(tax_moves, function(item) {
                        if (button.attr('id') === item) {
                            console.log(item);
                        }
                    })
                })
            })
        })
    })
}

$(function() {
    //firstButton();
    edit_table();
    window.setInterval(function () {
        edit_table();
    }, 100);
});