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
        for (let key in data) {
            console.log(data[key]['users'][0]['userName']);
            headingRow.innerHTML = '<th scope="col">' + 'Vehicles' + '</th><th scope="col">' + data[key]['users'][0]['userName'] + '</th><th scope="col">' + data[key]['users'][1]['userName'] + '</th><th scope="col">' + data[key]['users'][2]['userName'] + '</th>';
        }
    })
}

$(function() {
    fillUsernames();
});