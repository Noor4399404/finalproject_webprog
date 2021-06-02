// noinspection JSJQueryEfficiency

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

function edit_table(roundCounter) {
    $('#movement_table').show();
    let total_players = 1;
    if (roundCounter === 0) {
        $('#1').removeClass('btn-primary').addClass('btn-warning');
        let active_button = $('#1');
        active_button = active_button.attr('id');
        change_table(active_button);
    }
    else {
        $('.btn-success').click(function () {
            $('.btn-warning').addClass('btn-primary');
            $('.btn-warning').removeClass('btn-warning');
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-warning');
            let active_button = $(this).attr('id');
            change_table(active_button);
        })
    }
}

function change_table(active_button) {
    $.getJSON("data/possible_moves.json", function (data) {
        for(let key in data) {
            if (active_button === key) {
                let table_row = $('tr')[1];
                let tax_moves = data[active_button]['tax'];
                if (tax_moves === " ") {
                    tax_moves = "No moves!";
                }
                let bus_moves = data[active_button]['bus'];
                if (bus_moves === " ") {
                    bus_moves = "No moves!";
                }
                let und_moves = data[active_button]['und'];
                if (und_moves === " ") {
                    und_moves = "No moves!";
                }
                table_row.innerHTML = '<td>' + tax_moves + '</td><td>' + bus_moves + '</td><td>' + und_moves + '</td>';
                possible_moves(data, active_button);
            }
        }
    })
}

function possible_moves(data, key) {
    $('.btn-success').addClass('btn-primary');
    $('.btn-success').removeClass('btn-success');
    $(this).addClass('btn-success');
    $('.btn-primary').each(function() {
        let current_button = $(this);
        let value = $(this).attr('id');
        let tax_moves = data[key]['tax'].split(" ");
        $.each(tax_moves, function (i) {
            tax_moves[i] = parseInt(tax_moves[i]);
            tax_moves[i] = tax_moves[i].toString();
            if (value.trim() === tax_moves[i].trim()) {
                $(current_button).removeClass('btn-primary');
                $(current_button).addClass('btn-success');
            }
        })
        let bus_moves = data[key]['bus'].split(" ");
        $.each(bus_moves, function (i) {
            bus_moves[i] = parseInt(bus_moves[i]);
            bus_moves[i] = bus_moves[i].toString();
            if (value.trim() === bus_moves[i].trim()) {
                $(current_button).removeClass('btn-primary');
                $(current_button).addClass('btn-success');
            }
        })
        let und_moves = data[key]['und'].split(" ");
        $.each(und_moves, function (i) {
            und_moves[i] = parseInt(und_moves[i]);
            und_moves[i] = und_moves[i].toString();
            if (value.trim() === und_moves[i].trim()) {
                $(current_button).removeClass('btn-primary');
                $(current_button).addClass('btn-success');
            }
        })
    })
}

$(function() {
    let roundCounter = 0;
    edit_table(roundCounter);
    window.setInterval(function () {
        roundCounter += 1
        edit_table(roundCounter);
    }, 100);
});