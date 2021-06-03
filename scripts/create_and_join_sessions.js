// FUNCTIONS IN THE WAITING ROOM

var joinedGame = false

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
            if (response.tooManyPlayers) {
                console.log("worked kindof");
                window.location.href = "./index.php"
                alert(response)
            } else {
                joinedGame = true;
                sessionStorage.setItem("userId", randomUserId)
                sessionStorage.setItem("gameId", gameId)
                $("#join-game-form").addClass("d-none");
                $("#start-game-form").removeClass("d-none");
                return true
            }
        })
    });
}

var addedUsers = Array()
var misterXAdded = false;

function displayJoinedUsers(usersJSON) {
    let joinedUserIds = Array()
    for (user of usersJSON) {
        let userName = user.userName;
        let userId = user.id;
        joinedUserIds.push(userId);

        if (userName && !addedUsers.includes(user.id)) {
            addedUsers.push(user.id)     
            let listItemText = $(`<div id="joined-user-info-${userId}" class="name-joined-users-label"></div>`).text(userName);
            let listItem = $(`<li id="list-item-joined-user-${userId}" class="list-group-item d-flex" role="alert"></li>`).append(listItemText)
            if (user.id == sessionStorage.getItem("userId")) {
                let badgeElement = $(`<span class="badge ml-2 pt-1 text-white bg-secondary"></span>`).text("you");
                listItemText.append(badgeElement)
            } else if (user.isHost) {
                let badgeElement = $(`<span class="badge ml-2 pt-1 text-white bg-secondary"></span>`).text("host");
                listItemText.append(badgeElement);
            }  

            if ($("#is-host").val() == 1) {
                let hostActionButtons = $(`<div id="host-action-buttons-${userId}" class="host-action-buttons"></button>`)
                listItem.append(hostActionButtons)
                if (!misterXAdded) {
                    let misterXButton = $(`<button id="mister-X-button-${userId}" class="mister-X-button host-action-button"></button>`).html('<img src="./images/icons/spy.png" alt="mister X">');
                    hostActionButtons.append(misterXButton)
                }
                if (userId != sessionStorage.getItem("userId")) {
                    let deleteButton = $(`<button id="delete-user-button-${userId}" class="delete-user-button host-action-button"></button>`).html('<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>');
                    hostActionButtons.append(deleteButton);
                } 
            } 

            $("#list-joined-users").append(listItem);
        }

        if (user.isMisterX && !misterXAdded) {
            let badgeElement = $(`<span class="badge ml-2 pt-1 text-white bg-secondary"></span>`).text("mister X");
            $(`#joined-user-info-${userId}`).append(badgeElement);
            misterXAdded = true
            console.log("hoi");
        }
        
    }

    for (addedUserId of addedUsers) {
        if (!joinedUserIds.includes(addedUserId)) {
            $(`#list-item-joined-user-${addedUserId}`).remove();
        }
    }
}


function hostActions(action) {
    let classNameButton = "";
    switch (action) {
        case "delete":
            classNameButton = ".delete-user-button"
            break;
        case "appointX":
            classNameButton = ".mister-X-button"
            if (misterXAdded) {
                return
            }
            break
    }

    $(document).on('click', classNameButton, function(event) {
        let userId = Number($(this).parent().parent().attr("id").replace("list-item-joined-user", "")) * -1;
        // for some reason the id becomes negative ... 
        console.log("does work");
        let request = $.post("./scripts/host_actions.php", {
            gameId: sessionStorage.getItem("gameId"),
            hostUserId: sessionStorage.getItem("userId"),
            action: action,
            editedUserId: userId
        })
        request.then((response) => {
            if (action == "appointX") {
                $(".mister-X-button").fadeOut()
            }
            console.log(response);
        })
    });
}


// the javascript for hostActions is finished, the php needs to be changed though

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


// FUNCTIONS ON THE GAME PAGE

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




// FUNCTIONS ON THE HOME PAGE

function startHostingGame() {
    // function used on homepage: it will create a random number, which will become the game ID.  
    $("#start-game-button").click(function () {
        var randomGameId = Math.floor(Math.random() * 900000) + 100000;
        sessionStorage.setItem("gameId", randomGameId);

        // only one game id gets posted and that is the one that is made three lines above.
        $("#join-game-code-input").remove();
        $(this).prev().attr("value", String(randomGameId));

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

// GENERAL FUNCTIONS

function endGameSession() {
    $("#end-game-button").click(function(event) {
        event.preventDefault();
        let request = $.post("./scripts/end_game_session.php", {
            gameId: sessionStorage.getItem("gameId"),
            isHost: $("#is-host").val()
        })
        request.then((response) => {
            window.location.href = "./index.php";
        })
    })
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

// PAGE FUNCTIONS

function homeFunctions() {
    $("#container-div").removeClass("container");
    // While the container is useful on all other pages to prevent elements from sticking to the side of the screen, on the home page this needs to happen for the picture.
    startHostingGame();
    startJoiningGame();
    stopJoiningGame();
}

function waitingPageFunctions() {
    sessionStorage.setItem("gameId", $("#game-id").val())
    window.setInterval(() => {
        if (joinedGame) {
            getGameInformation();
        }
    }, 3000);
    endGameSession();
    joinGame();
    hostActions("delete");
    hostActions("appointX");
    clickToCopy("#game-id-card", "#copy-game-id-info");
}

function gamePageSessionFunctions() {
    startGame();
    endGameSession();
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
            waitingPageFunctions();
            break;

        case "start_game_join_test.php":
            gamePageSessionFunctions();
            break;
    }
})