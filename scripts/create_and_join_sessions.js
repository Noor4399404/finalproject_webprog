function joinGame() {
    $("#join-game-name").click(function (event) {
        event.preventDefault();
        let randomUserId = Math.floor(Math.random() * 9000000) + 1000000;
        let gameId = $("#game-id").val()
        console.log($("#game-id").val(),);
        let request = $.post("./scripts/add_name_to_session.php", {
            gameId: gameId,
            userId: randomUserId,
            userName: $("#user-name-input").val(),
            isHost: $("#is-host").val()
        });
        request.then((response) => {
            sessionStorage.setItem("userId", randomUserId)
            sessionStorage.setItem("gameId", gameId)
            $("#join-game-form").addClass("d-none");
            $("#start-game-form").removeClass("d-none");
        })
    });
}

function addIdToPage(elementId, sortId) {
    switch (sortId) {
        case "game":
            let gameId = sessionStorage.getItem("gameId");
            $(`#${elementId}`).val(gameId);
            break;

        case "user":
            let userId = sessionStorage.getItem("userId");
            $(`#${elementId}`).val(userId);
            break;
    }
}

var addedUsers = [];

function displayJoinedUsers(usersJSON) {
    for (user of usersJSON) {
        let userName = user.userName;
        if (userName && !addedUsers.includes(user.id)) {
            addedUsers.push(user.id)            
            let listItem = $(`<li class="list-group-item" role="alert"></li>`).text(userName);

            if (user.id == sessionStorage.getItem("userId")) {
                let badgeElement = $(`<span class="badge ml-2 text-white bg-secondary"></span>`).text("you");
                listItem.append(badgeElement)
            } else if (user.isHost) {
                let badgeElement = $(`<span class="badge ml-2 text-white bg-secondary"></span>`).text("host");
                listItem.append(badgeElement)
            }
            $("#list-joined-users").append(listItem);
        }
    }
}

function getGameInformation() {
    let request = $.post("./scripts/get_joined_users.php", {
        gameId: sessionStorage.getItem("gameId"),
    });
    request.then(response => JSON.parse(response))
        .then((response) => {
            if (response.gameStarted === true) {
                window.location.href = "./start_game_join_test.php"
            }
            displayJoinedUsers(response.users);
            console.log(response);
        })
}

function startGame() {
    // function on the gamepage: game started is changed to true, so other players will join as well.
    let request = $.post("./scripts/start_game_session.php", {
        gameId: sessionStorage.getItem("gameId"),
        isHost: $("#isHost").val()
    });
    request.then((response) => {
        console.log(response);
        console.log("Other players are starting now as well");
    })
}

function startHostingGame() {
    // function used on homepage: it will create a random number, which will become the game ID.  
    $("#start-game-button").click(function () {
        var randomGameId = Math.floor(Math.random() * 900000) + 100000;
        $("#join-game-code-input").remove()
        console.log(randomGameId);
        $(this).prev().attr("value", String(randomGameId));

    });
}

function clickToCopy(clickElementID, messageElementID) {
    $(clickElementID).click(function () {
        let valueClickElement = $(this).text();
        valueClickElement = valueClickElement.replace(/ /g, '').replace("#", "");

        const el = document.createElement('textarea');
        el.value = valueClickElement;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        // This was copied completely from another website

        $(messageElementID).removeClass("text-muted").addClass("text-success");
        $(messageElementID).text("The game ID has been copied to your clipboard.");
    });

}

function startJoiningGame() {
    // function used on homepage: show an input element for someone to enter the game ID.
    $("#join-game-button").click(function(event) {
        if ($("#join-game-button").hasClass("enter-game-id-button")) {
            event.stopPropagation();
            event.stopImmediatePropagation()
            event.preventDefault();
            $("#join-game-button").removeClass("enter-game-id-button");
            $("#host-game-code-input").hide();
            $("#start-game-button").hide();
            $("#join-game-code-input").removeClass("d-none").addClass("d-inline-block");
        } else {
            $("#host-game-code-input").remove();
            $("#start-game-button").remove();
        }
    });
}


function stopJoiningGame() {
    $("#home-header").click(function(event) {
        if (!$("#join-game-button").hasClass("enter-game-id-button") && event.target !== document.getElementById("join-game-code-input") && event.target !== document.getElementById("join-game-button")) {
            event.stopPropagation();
            event.stopImmediatePropagation()
            $("#join-game-button").addClass("enter-game-id-button");
            $("#host-game-code-input").show();
            $("#start-game-button").show();
            $("#join-game-code-input").addClass("d-none").removeClass("d-inline-block");
        }
    });
}

function homeFunctions() {
    $("#container-div").removeClass("container");
    startHostingGame();
    startJoiningGame();
    stopJoiningGame();
}


$(function () {
    let windowLocation = $(location).attr("pathname");
    windowLocation = windowLocation.split("/").pop()
    console.log(windowLocation);

    switch (windowLocation) {
        case "":
            homeFunctions();
            break;
        case "index.php":
            homeFunctions();
            break;

        case "join_game_test.php":
            window.setInterval(() => {
                getGameInformation();
            }, 3000);

            sessionStorage.setItem("gameId", $("#game-id").val())

            joinGame();
            clickToCopy("#game-id-card", "#copy-game-id-info");
            break;

        case "start_game_join_test.php":
            startGame();
            break;
    }
})