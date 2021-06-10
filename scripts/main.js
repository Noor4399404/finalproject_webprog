function useModal(modalTitle, modalText, closeButtonText, closeModalAction = () => {}, twoActions = false,  otherButtonText = String(), otherModalAction = () => {}) {
    $('#info-modal').modal('show');
    $("#modal-title").text(modalTitle);
    $("#modal-text").text(modalText);
    if (twoActions) {
        let otherButton = $('<button type="button" class="btn btn-danger" id="other-modal-button" data-dismiss="modal"></button>').text(otherButtonText);
        if ($("#modal-footer").find("#other-modal-button").length < 1) {
            $("#modal-footer").append(otherButton)
        }
        $("#other-modal-button").click(function() {
            $('#info-modal').modal('hide');
            otherModalAction();
        })
    }
    $("#modal-close").text(closeButtonText);
    $("#modal-close").click(function() {
        $('#info-modal').modal('hide');
        closeModalAction();
    })
}

function fillData() {
    //let json_data = $.post("./scripts/read_json.php", {call_now: "True"});
    window.sessionStorage.setItem("userId", "1234567");
    //json_data.done(function (data) {
    $.getJSON("data/test_sessions.json", function (data) {
        let vehicleButtons = $('#move_buttons > p');
        for (let key in data) {
            for (let user in data[key]['users']) {
                 if (data[key]['users'][user]['id'] !== window.sessionStorage.getItem("userId")) {
                     $('#moves_table tbody').append('<tr></tr>');
                     let correctRow = $('#moves_table tbody tr').last();
                     correctRow.append(`<td style="color: #${data[key]["users"][user]["color"]}; filter: brightness(1.2);">` + data[key]["users"][user]["username"] + '</td>');
                     correctRow.append('<td>' + data[key]["users"][user]["cardAmount"]["tax"] + '</td>');
                     correctRow.append('<td>' + data[key]["users"][user]["cardAmount"]["bus"] + '</td>');
                     correctRow.append('<td>' + data[key]["users"][user]["cardAmount"]["und"] + '</td>');

                 }
                 if (data[key]['users'][user]['id'] === window.sessionStorage.getItem("userId")) {
                     vehicleButtons[0].innerHTML = '<p class="mb-0 text-white">' + data[key]['users'][user]['cardAmount']['tax'] + '</p>';
                     vehicleButtons[1].innerHTML = '<p class="mb-0 text-white">' + data[key]['users'][user]['cardAmount']['bus'] + '</p>';
                     vehicleButtons[2].innerHTML = '<p class="mb-0 text-white">' + data[key]['users'][user]['cardAmount']['und'] + '</p>';

                     $('#station').text('Current Location: ' + data[key]['users'][user]['location']);
                 }
            }
        }
    })
}

$(function() {
    // fillData();
    //window.setInterval(function () {
        //fillData();
    //}, 1000);
});