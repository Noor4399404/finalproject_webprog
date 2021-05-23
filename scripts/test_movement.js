function firstButton(){
    $('#numberOne').click(function () {
        $('#numberOne').removeClass('btn-primary');
        $('#numberOne').addClass('btn-danger');
    });
}

$(function() {
    firstButton();
});