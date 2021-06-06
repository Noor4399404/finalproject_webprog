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

function fillUsernames() {
    $.getJSON("data/test_sessions.json", function (data) {
        let headingRow = $('#moves_table tr')[0];
        let rows = $('#moves_table tbody tr');

        let firstRow = rows[0].childNodes;
        let secondRow = rows[1].childNodes;
        let thirdRow = rows[2].childNodes;

        let vehicleButtons = $('.vehicle_button_div p');
        console.log(vehicleButtons);

        for (let key in data) {
            headingRow.innerHTML = '<th scope="col">' + 'Vehicles' + '</th><th scope="col">' + data[key]['users'][0]['username'] + '</th><th scope="col">' + data[key]['users'][1]['username'] + '</th><th scope="col">' + data[key]['users'][2]['username'] + '</th>';

            firstRow[3].innerHTML = '<td>' + data[key]['users'][0]['cardAmount']['tax'] + '</td>';
            firstRow[5].innerHTML = '<td>' + data[key]['users'][1]['cardAmount']['tax'] + '</td>';
            firstRow[7].innerHTML = '<td>' + data[key]['users'][2]['cardAmount']['tax'] + '</td>';

            secondRow[3].innerHTML = '<td>' + data[key]['users'][0]['cardAmount']['bus'] + '</td>';
            secondRow[5].innerHTML = '<td>' + data[key]['users'][1]['cardAmount']['bus'] + '</td>';
            secondRow[7].innerHTML = '<td>' + data[key]['users'][2]['cardAmount']['bus'] + '</td>';

            thirdRow[3].innerHTML = '<td>' + data[key]['users'][0]['cardAmount']['und'] + '</td>';
            thirdRow[5].innerHTML = '<td>' + data[key]['users'][1]['cardAmount']['und'] + '</td>';
            thirdRow[7].innerHTML = '<td>' + data[key]['users'][2]['cardAmount']['und'] + '</td>';

            vehicleButtons[0].innerHTML = '<p class="mb-0 text-white">' + data[key]['users'][3]['cardAmount']['tax'] + '</p>';
            vehicleButtons[1].innerHTML = '<p class="mb-0 text-white">' + data[key]['users'][3]['cardAmount']['bus'] + '</p>';
            vehicleButtons[2].innerHTML = '<p class="mb-0 text-white">' + data[key]['users'][3]['cardAmount']['und'] + '</p>';

        }
    })
}

$(function() {
    fillUsernames();
});