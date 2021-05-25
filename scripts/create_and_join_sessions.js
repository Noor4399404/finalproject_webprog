function joinGame() {
    $("#join-game-name").click(function(event) {
        event.preventDefault();
        var randomUserId = Math.floor(Math.random() * 10000000);
        console.log($("#game-id").val(), );
        let request = $.post("./scripts/add_name_to_session.php", {
            gameId: $("#game-id").val(),
            userId: randomUserId,
            userName: $("#user-name-input").val(),
            isHost: $("#is-host").val()
        });
        request.then((response) => {
            $("#join-game-form").addClass("d-none");
            $("#start-game-form").removeClass("d-none");
        })
    });
}

var addedUsers = [];

function displayJoinedUsers(usersJSON) {
    for (user of usersJSON) {
        let userName = user.userName;
        if (userName && !addedUsers.includes(user.id)) {
            addedUsers.push(user.id)
            let listItem = $('<li class="list-group-item"></li>').text(userName);
            $("#list-joined-users").append(listItem);
        }
    }
}

function getGameInformation() {
    let request = $.post("./scripts/get_joined_users.php", {
        gameId: $("#game-id").val(),
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
        gameId: $("#gameId").val(),
        isHost: $("#isHost").val()
    });
    request.then((response) => {
        console.log(response);
        console.log("Other players are starting now as well");
    })
}

function startHostingGame() {
    // function used on homepage: it will create a random number, which will become the game ID.  
    $("#start-game-button").click(function() {
        var randomGameId = Math.floor(Math.random() * 100000) + 10000;
        $("#join-game-code-input").remove()
        console.log(randomGameId);
        $(this).prev().attr("value", String(randomGameId));
    
    });
}

function clickToCopy (clickElementID, messageElementID) {
    $(clickElementID).click(function() {
        let valueClickElement = $(this).text();
        valueClickElement = valueClickElement.replace(/ /g,'').replace("#", "");

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
    $("#join-game-button").one("click", function(event) {
        event.preventDefault();
        $("#host-game-code-input").remove();
        $("#start-game-button").remove();
        $("#join-game-code-input").removeClass("d-none").addClass("d-inline-block");
    });
}

$(function() {
    let windowLocation = $(location).attr("pathname");
    windowLocation = windowLocation.split("/").pop()
    console.log(windowLocation);

    switch (windowLocation) {
        case "":
            $("#container-div").removeClass("container");
            startHostingGame();
            startJoiningGame();
            break;
        case "index.php":
            $("#container-div").removeClass("container");
            startHostingGame();
            startJoiningGame();
            break;

        case "join_game_test.php":
            window.setInterval(() => {
                getGameInformation();
            }, 3000);
            joinGame();
            clickToCopy("#game-id-card", "#copy-game-id-info");
            break;

        case "start_game_join_test.php":
            startGame();
            break;
    }
})