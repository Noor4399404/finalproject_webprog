class Game {

    constructor() {

        this.canvas = document.getElementById("gameCanvas");
        this.ctx = this.canvas.getContext("2d");

        this.backgroundSRC = "./images/gameBoard_medRes.JPG";
        this.userIcons = [];

        this.setupCanvas();

        this.addBackground();
        this.canvas_positions = this.canvas.getBoundingClientRect();

        this.triggerSize = {
            "x": this.canvas.width * 0.015,
            "y": this.canvas.height * 0.025
        };

        this.clickSense = this.canvas.width * 0.004;

        this.userId = window.sessionStorage['userId']
        this.gameId = window.sessionStorage['gameId']

    }

    //METHODS TO SET UP THE GAME AND GET INITIAL DATA --- --- --- --- --- ---

    getTriggers(triggerLocations) {
        //helper function to store trigger locations in game class
        this.triggerLocations = triggerLocations;
    }

    getPossibleMoves(possibleMoves) {
        //helper function to store possible moves in game class
        this.possibleMoves = possibleMoves;
    }

    getSessionData(sessionData) {
        //helper function to store session data in game class
        this.sessionData = JSON.parse(sessionData);
        //console.log(this.sessionData);
    }

    setupCanvas() {
        //creates canvas (size & background) and determines where the rest of the UI is placed

        this.canvas.width = window.innerWidth * 0.97 * window.devicePixelRatio;
        this.canvas.height = window.innerHeight * 0.90 * window.devicePixelRatio;
        this.ratio = 4312 / 3256; // Change to pixels of image

        if (this.canvas.height < this.canvas.width / this.ratio) {
            this.canvas.width = this.canvas.height * this.ratio;
        } else {
            this.canvas.height = this.canvas.width / this.ratio;
        }

        if (this.canvas.width / devicePixelRatio / 2 > window.innerWidth / 3) {
            this.canvas.width = window.innerWidth / 3 * 2 * window.devicePixelRatio;
            this.canvas.height = this.canvas.width / this.ratio
        }

        this.ctx.scale(window.devicePixelRatio, window.devicePixelRatio);

        this.canvas.style.width = (this.canvas.width / devicePixelRatio) + "px";
        this.canvas.style.height = (this.canvas.height / devicePixelRatio) + "px";

        if (window.innerWidth < window.innerHeight || window.innerWidth < 991.98) {
            document.getElementById("gamebody").style.flexDirection = "column"
            document.getElementById("game-information").style.width = "75%"
        } else {
            let widthGameInformation = (window.innerWidth - this.canvas.width / devicePixelRatio - 40)
            document.getElementById("game-information").style.width = widthGameInformation + "px";
            document.getElementById("gamebody").style.flexDirection = "row"
        }
    }

    addBackground() {
        //sets the background, with correct size

        var ctx = this.ctx;
        var canvas = this.canvas;

        var background = new Image();
        background.src = this.backgroundSRC;

        background.onload = function () {
            ctx.drawImage(
                background, 0, 0,
                canvas.width / window.devicePixelRatio,
                canvas.height / window.devicePixelRatio);
        }
    }

    fillData() {
        //let json_data = $.post("./scripts/read_json.php", {call_now: "True"});
        // window.sessionStorage.setItem("userId", "1234567");
        //json_data.done(function (data) {
        let data = this.sessionData
        console.log(data);
        let vehicleButtons = $('.vehicle_button_div > p');
        for (let user in data['users']) {
            if (data['users'][user]['id'] != window.sessionStorage.getItem("userId")) {
                $('#moves_table tbody').append(`<tr id="moves_table_row${data['users'][user]['id']}" ></tr>`);
                let correctRow = $('#moves_table tbody tr').last();
                correctRow.append(`<td style="color: #${data["users"][user]["color"]}; filter: brightness(1.2);">` + data["users"][user]["userName"] + '</td>');
                correctRow.append('<td>' + data["users"][user]["cardAmount"]["tax"] + '</td>');
                correctRow.append('<td>' + data["users"][user]["cardAmount"]["bus"] + '</td>');
                correctRow.append('<td>' + data["users"][user]["cardAmount"]["und"] + '</td>');

            }
            if (data['users'][user]['id'] == window.sessionStorage.getItem("userId")) {

                if (data['users'][user]["myTurn"]) {
                    this.submitCanBeDisabled = true;
                } else {
                    $("#submit-move-button").addClass("inactive-vehicle-button")
                    this.submitCanBeDisabled = false;
                    $("#submit-move-button").attr('disabled', true);
                }
                vehicleButtons[0].innerHTML = '<p class="mb-0 text-white">' + data['users'][user]['cardAmount']['tax'] + '</p>';
                vehicleButtons[1].innerHTML = '<p class="mb-0 text-white">' + data['users'][user]['cardAmount']['bus'] + '</p>';
                vehicleButtons[2].innerHTML = '<p class="mb-0 text-white">' + data['users'][user]['cardAmount']['und'] + '</p>';

                $('#station').text('Current Location: ' + data['users'][user]['location']);
            }

        }
    }

    addUserIcon(users) {
        //adds icon to the canvas for every user

        for (let userIndex in this.sessionData["users"]) {
            let user = this.sessionData["users"][userIndex]
            let userId = user.id;
            let startLocation = user.location;
            let color = user.color;

            let canvas_positions = this.canvas_positions;
            let userIcon = $(`<svg class="userIconImage" id="userIconImage_${userId}") xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"><g><rect fill="none" height="24" width="24"/></g><g><g/><g><circle cx="12" cy="4" r="2"/><path d="M15.89,8.11C15.5,7.72,14.83,7,13.53,7c-0.21,0-1.42,0-2.54,0C8.24,6.99,6,4.75,6,2H4c0,3.16,2.11,5.84,5,6.71V22h2v-6h2 v6h2V10.05L18.95,14l1.41-1.41L15.89,8.11z"/></g></g></svg>`)
            console.log(user.isMisterX && userId == sessionStorage.getItem("userId"));
            console.log(!user.isMisterX);
            if ((user.isMisterX && userId == sessionStorage.getItem("userId")) || !user.isMisterX) {
                let x = this.triggerLocations[startLocation]["x"] * this.canvas.width / devicePixelRatio + canvas_positions.left - 8
                let y = this.triggerLocations[startLocation]["y"] * this.canvas.height / devicePixelRatio + canvas_positions.top - 6
                $("body").append(userIcon)

                $(`#userIconImage_${userId}`).css("position", "absolute").css("top", y).css("left", x).css("z-index", 10).css("fill", `#${color}`).css("width", 30).css("height", 30)
            }
        }
    }

    getHost() {
        //establishes which player is the host, and sets this.isHost to true

        const userId = window.sessionStorage.getItem("userId");

        for (let user in this.sessionData["users"]) {
            if (this.sessionData["users"][user]["id"] == userId) {
                if (this.sessionData["users"][user]["isHost"] == "1") {
                    this.isHost = true;
                } else {
                    this.isHost = false;
                }
            }
        }
    }

    getMisterX() {
        //establishes which player is mister X, and sets this.isMrX to true

        for (let user in this.sessionData["users"]) {
            if (this.sessionData["users"][user]["id"] == this.userId) {
                if (this.sessionData["users"][user]["isMisterX"]) {
                    this.isMrX = true;
                } else {
                    this.isMrX = false;
                }
            }
        }
    }

    //RESIZING FUNCTIONS --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---

    resize() {
        //makes sure the game looks correct with window resize

        this.setupCanvas();
        this.addBackground();
        this.canvas_positions = this.canvas.getBoundingClientRect();
        this.resizeUserIcons();

        this.clickSense = this.canvas.width * 0.004;

        this.triggerSize = {
            "x": this.canvas.width * 0.015,
            "y": this.canvas.height * 0.025
        };

    }

    resizeUserIcons() {
        //resizes the user icons to match the canvas
        let canvas_positions = this.canvas_positions

        for (let userIndex in this.sessionData["users"]) {
            let user = this.sessionData["users"][userIndex]
            let currentLocation = user["location"];
            console.log(currentLocation);
            let userId = user["id"];
            console.log(userId);
            let x = this.triggerLocations[currentLocation]["x"] * this.canvas.width / devicePixelRatio + canvas_positions.left - 5;
            let y = this.triggerLocations[currentLocation]["y"] * this.canvas.height / devicePixelRatio + canvas_positions.top - 2;
            $(`#userIconImage_${userId}`).css("top", y).css("left", x)
        }
    }

    //CANVAS INTERACTION --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---

    getMousePosition(event) {
        //sets mouseX and mouseY to most recent click

        var rect = this.canvas.getBoundingClientRect();
        this.mouseX = event.clientX * devicePixelRatio - rect.left * devicePixelRatio;
        this.mouseY = event.clientY * devicePixelRatio - rect.top * devicePixelRatio;
        //console.log("X: " + this.mouseX + "\tY: " + this.mouseY);
    }

    scanForTrigger() {
        //takes the current mouse coordinates and scans for a clicked trigger

        const location_list = Object.entries(this.triggerLocations);

        for (let location in location_list) {
            //console.log(location_list[location]);
            for (let coordinate in location_list[location]) {

                const topBoundary = (location_list[location][coordinate]["y"] * this.canvas.height) - this.clickSense;
                const bottomBoundary = (location_list[location][coordinate]["y"] * this.canvas.height) + this.triggerSize["y"] + this.clickSense;
                const leftBoundary = (location_list[location][coordinate]["x"] * this.canvas.width) - this.clickSense;
                const rightBoundary = (location_list[location][coordinate]["x"] * this.canvas.width) + this.triggerSize["x"] + this.clickSense;

                if (this.mouseX > leftBoundary &&
                    this.mouseX < rightBoundary &&
                    this.mouseY < bottomBoundary &&
                    this.mouseY > topBoundary) {

                    return (parseInt(location) + 1);
                }
            }
        }
    }

    showPossibleMoves(location, vehicle) {
        //shows the possible moves for the current location and selected vehicle

        $(".showPossibleMoves").remove()

        for (let key in this.possibleMoves) {
            if (key == location) {
                var litupLocations = this.possibleMoves[key][vehicle].split(", ");
            }
        }

        if (vehicle == "tax") {
            var colour = "yellow"
        } else if (vehicle == "bus") {
            var colour = "green"
        } else if (vehicle == "und") {
            var colour = "pink"
        }

        for (let location in litupLocations) {
            if (this.noCollision(location)) {
                for (let coordinate in this.triggerLocations) {
                    if (coordinate == litupLocations[location]) {
                        let icon = $(`<svg class="showPossibleMoves" id="show${coordinate}" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"/></g><g><path d="M12,2C6.47,2,2,6.47,2,12c0,5.53,4.47,10,10,10s10-4.47,10-10C22,6.47,17.53,2,12,2z M12,20c-4.42,0-8-3.58-8-8 c0-4.42,3.58-8,8-8s8,3.58,8,8C20,16.42,16.42,20,12,20z"/></g></svg>`)
                        let x = this.triggerLocations[coordinate]["x"] * this.canvas.width / devicePixelRatio + this.canvas_positions.left - 8
                        let y = this.triggerLocations[coordinate]["y"] * this.canvas.height / devicePixelRatio + this.canvas_positions.top - 6
                        $("body").append(icon)
        
                        $(`#show${coordinate}`).css("position", "absolute").css("top", y).css("left", x).css("z-index", 10).css("fill", `#${colour}`).css("width", 30).css("height", 30)
                    }
                }
            }
            
        }
    }

    isPossibleMove(location, vehicle, nextLocation) {
        //tests if the user can move to their next location using the selected vehicle

        for (let key in this.possibleMoves) {
            if (key == location) {
                for (let loc in this.possibleMoves[key][vehicle].split(", ")) {
                    if (this.possibleMoves[key][vehicle].split(", ")[loc] == nextLocation) {
                        return true;
                    }
                }
                return false;
            }
        }
    }

    noCollision(newLocation) {
        //tests for collision with other users when a user wants to move

        let userLocations = []

        if (this.isMrX) {
            return true;
        } else {
            for (let user in this.sessionData["users"]) {
                if (this.sessionData["users"][user]["isMisterX"] == false) {
                    userLocations.push(this.sessionData["users"][user]["location"])
                }
            }
        }

        if (userLocations.includes(newLocation)) {
            return false;
        } else {
            return true;
        }
    }


    //INTERFACE UPDATE --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---

    moveUserIcon(user) {
        //moves user icon to the new location
        let userId = user.id;
        let newLocation = user.location;

        let canvas_positions = this.canvas_positions;
        let x = this.triggerLocations[newLocation]["x"] * this.canvas.width / devicePixelRatio + canvas_positions.left - 8;
        let y = this.triggerLocations[newLocation]["y"] * this.canvas.height / devicePixelRatio + canvas_positions.top - 6;
        $(`#userIconImage_${userId}`).css("top", y).css("left", x);
    }


    updateFillData() {
        $("#round-number-info").html(`<p style="font-weight: light;">round ${this.sessionData["round"]}</p>`)
        let data = this.sessionData
        console.log(data);
        let vehicleButtons = $('.vehicle_button_div > p');
        for (let user in data['users']) {
            if (data['users'][user]['id'] != window.sessionStorage.getItem("userId")) {
                let dataCells = $(`#moves_table_row${data["users"][user]["id"]}`).children();
                //console.log(dataCells);
                $(dataCells[1]).html(data["users"][user]["cardAmount"]["tax"]);
                $(dataCells[2]).html(data["users"][user]["cardAmount"]["bus"]);
                $(dataCells[3]).html(data["users"][user]["cardAmount"]["und"]);

            }
            if (data['users'][user]['id'] == window.sessionStorage.getItem("userId")) {

                if (data['users'][user]["myTurn"]) {
                    this.submitCanBeDisabled = true;
                    $(".vehicle_buttons").removeAttr("disabled");
                } else {
                    $("#submit-move-button").addClass("inactive-vehicle-button");
                    this.submitCanBeDisabled = false;
                    $("#submit-move-button").attr('disabled', true);
                }

                vehicleButtons[0].innerHTML = '<p class="mb-0 text-white">' + data['users'][user]['cardAmount']['tax'] + '</p>';
                vehicleButtons[1].innerHTML = '<p class="mb-0 text-white">' + data['users'][user]['cardAmount']['bus'] + '</p>';
                vehicleButtons[2].innerHTML = '<p class="mb-0 text-white">' + data['users'][user]['cardAmount']['und'] + '</p>';

                $('#station').text('Current Location: ' + data['users'][user]['location']);
            }

        }

        let mrXTableElements = $("#mrxtable > tbody > tr > td")
        //console.log(mrXTableElements);
        for (let user in this.sessionData["users"]) {
            if (this.sessionData["users"][user]["isMisterX"]) {
                let usedVehicles = this.sessionData["users"][user]["usedVehicles"];
                if (usedVehicles.length != 0) {
                    let index = usedVehicles.length - 1;
                    let lastUsedVehicle = usedVehicles[index]
                    let tableElement = mrXTableElements[index]
                    switch (lastUsedVehicle) {
                        case "tax":
                            tableElement.html(`<div class="border-warning border vehicle_info_div">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
                                                    <circle cx="7.5" cy="14.5" r="1.5" />
                                                    <circle cx="16.5" cy="14.5" r="1.5" />
                                                </svg>
                                            </div>`)
                            break;
                        case "bus":
                            tableElement.html(`<div class="border-info border vehicle_info_div">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M12 2c-4.42 0-8 .5-8 4v10c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4zm5.66 2.99H6.34C6.89 4.46 8.31 4 12 4s5.11.46 5.66.99zm.34 2V10H6V6.99h12zm-.34 9.74l-.29.27H6.63l-.29-.27C6.21 16.62 6 16.37 6 16v-4h12v4c0 .37-.21.62-.34.73z" />
                                                    <circle cx="8.5" cy="14.5" r="1.5" />
                                                    <circle cx="15.5" cy="14.5" r="1.5" />
                                                </svg>
                                            </div>`)
                            break;
                        case "und":
                            tableElement.html(`<div class="border-danger border vehicle_info_div">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path d="M17.8 2.8C16 2.09 13.86 2 12 2s-4 .09-5.8.8C3.53 3.84 2 6.05 2 8.86V22h20V8.86c0-2.81-1.53-5.02-4.2-6.06zM9.17 20l1.5-1.5h2.66l1.5 1.5H9.17zm-2.16-6V9h10v5h-10zm9.49 2c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1zm-8-1c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM20 20h-3.5v-.38l-1.15-1.16c1.49-.17 2.65-1.42 2.65-2.96V9c0-2.63-3-3-6-3s-6 .37-6 3v6.5c0 1.54 1.16 2.79 2.65 2.96L7.5 19.62V20H4V8.86c0-2 1.01-3.45 2.93-4.2C8.41 4.08 10.32 4 12 4s3.59.08 5.07.66c1.92.75 2.93 2.2 2.93 4.2V20z" />
                                                </svg>
                                            </div>`)
                            break;
                    }

                }


            }
        }
    }


    addMisterXIcon() {
        for (let userIndex in this.sessionData["users"]) {
            if (this.sessionData["users"][userIndex]["isMisterX"]) {
                let user = this.sessionData["users"][userIndex]
                let startLocation = user.location;
                let color = user.color;

                let canvas_positions = this.canvas_positions;
                let userIcon = $(`<svg class="userIconImage" id="MisterXRevealIcon") xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"><g><rect fill="none" height="24" width="24"/></g><g><g/><g><circle cx="12" cy="4" r="2"/><path d="M15.89,8.11C15.5,7.72,14.83,7,13.53,7c-0.21,0-1.42,0-2.54,0C8.24,6.99,6,4.75,6,2H4c0,3.16,2.11,5.84,5,6.71V22h2v-6h2 v6h2V10.05L18.95,14l1.41-1.41L15.89,8.11z"/></g></g></svg>`)
                let x = this.triggerLocations[startLocation]["x"] * this.canvas.width / devicePixelRatio + canvas_positions.left - 8
                let y = this.triggerLocations[startLocation]["y"] * this.canvas.height / devicePixelRatio + canvas_positions.top - 6
                $("body").append(userIcon)
                $(`#MisterXRevealIcon`).css("position", "absolute").css("top", y).css("left", x).css("z-index", 10).css("fill", `#${color}`).css("width", 30).css("height", 30)
            }
        }
    }


    //HELPER METHODS --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---

    showTriggers() {

        //higlights all placed triggers for dev purposes

        const location_list = Object.entries(this.triggerLocations);

        for (let location in location_list) {
            //console.log(location_list[location]);
            for (let coordinate in location_list[location]) {

                this.ctx.beginPath();
                this.ctx.rect(
                    location_list[location][coordinate]["x"] * this.canvas.width,
                    location_list[location][coordinate]["y"] * this.canvas.height,
                    this.triggerSize["x"], this.triggerSize["y"]
                );
                this.ctx.lineWidth = 1;
                this.ctx.strokeStyle = 'red';
                this.ctx.stroke();

            }
        }
    }

    triggerHelper() {

        //help get trigger locations    
        //click in the middle and if the square is correct, copy the console coordinates to the json file

        const topLeft = {
            "x": (this.mouseX - (this.triggerSize["x"] / 2)) / this.canvas.width,
            "y": (this.mouseY - (this.triggerSize["y"] / 2)) / this.canvas.height
        }

        //draws a square where clicked
        this.ctx.beginPath();
        this.ctx.rect(
            topLeft["x"] * this.canvas.width, topLeft["y"] * this.canvas.height,
            this.triggerSize["x"], this.triggerSize["y"]
        );
        this.ctx.lineWidth = 1;
        this.ctx.strokeStyle = 'red';
        this.ctx.stroke();

        console.log(topLeft);

        //copy the coordinates to the clipboard
        var textArea = document.createElement("textarea");
        textArea.value = '{"x": ' + topLeft["x"] + ', "y": ' + topLeft["y"] + '},';
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);

    }

    //GAME LOOP METHODS --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---

    updateInterface() {

    }

    gameLoop() {


    }

}

$(function () {

    $("#game-main-element").addClass("d-none").parent().addClass("bg-dark");
    // making sure the user cannot interact with the screen while the game is loading

    var game = new Game();
    const canvas = document.getElementById("gameCanvas");

    var selectedVehicle = "None"

    console.log(sessionStorage.getItem("gameId"));

    let request_1 = $.post("scripts/get_session.php", {
        call_now: "True",
        gameId: sessionStorage.getItem("gameId")
    });
    let request_2 = $.post("scripts/get_triggers.php", { call_now: "True" });
    let request_3 = $.post("scripts/get_possible_moves.php", { call_now: "True" });
    const fetchAsyncData = async () => {
        // Here you have access to all the information that has been requested. Doing this in one function will make sure code will not run if some information has not been fetched yet.
        const res = await Promise.all([request_1, request_2, request_3])

        $("#game-main-element").removeClass("d-none");
        // When the game is loaded, the user should be able to interact with the website

        // code in the .done after the first request
        game.sessionData = res[0]
        console.log(game.sessionData);
        // game.getSessionData(sessionData); //is not necessary if you make the header inside php json.
        game.getHost();
        game.getMisterX();

        // code in the .done after the second request
        game.getTriggers(res[1]);

        console.log(game.detectives)
        game.addUserIcon(game.sessionData["users"])


        //Shows the clickable areas on the game board 

        // setTimeout(function(){
        //     game.showTriggers();
        // }, 100);

        // code in the .done after the third request
        game.getPossibleMoves(res[2]);
        game.fillData();


        // should be here, otherwise it will try to get new inforation, while the old information isnt even available
        window.setInterval(() => {
            let request = $.post("./scripts/update_session.php", { // could be another script name
                gameId: sessionStorage.getItem("gameId"),
                userId: sessionStorage.getItem("userId")
            })
            request.then((response) => {
                if (response.isChanged) {
                    game.sessionData = response;
                    for (let user in game.sessionData["users"]) {
                        game.moveUserIcon(game.sessionData["users"][user])
                    }
                    game.updateFillData();

                    if ([3, 8, 13, 18].includes(game.sessionData["round"])) {
                        game.addMisterXIcon();
                    } else {
                        $("#MisterXRevealIcon").remove();
                    }
                }
            })

        }, 2000)
    }

    fetchAsyncData();

    var usedVehicle;

    canvas.addEventListener("click", function (event) {

        game.getMousePosition(event);

        //The following copies the location of where you clicked in trigger_locations.json format
        //game.triggerHelper();

        var trigger = game.scanForTrigger();

        if (selectedVehicle != "None") {
            data = game.sessionData
            for (let user in data["users"]) {
                if (data["users"][user]["id"] == window.sessionStorage.getItem("userId")) {
                    if (game.isPossibleMove(data["users"][user]["location"], selectedVehicle, trigger)) {
                        usedVehicle = selectedVehicle;
                        selectedVehicle = "None"
                        data["users"][user]["location"] = trigger;
                        game.moveUserIcon(data["users"][user]);
                        if (game.submitCanBeDisabled) {
                            $("#submit-move-button").removeAttr("disabled");
                            $("#submit-move-button").removeClass("inactive-vehicle-button")
                        }
                    } else {
                        useModal("Not a valid move", "You're trying to make an invalid move, dummy", "close")
                    }

                }

            }
            game.updateFillData()
        } else {
            console.log('select a vhicle first, dummy');
        }



    });

    $("#hide-icons-button").on("mousedown", function () {
        $(".userIconImage").fadeOut("fast");
    });
    $("#hide-icons-button").on("mouseup", function () {
        $(".userIconImage").fadeIn("fast");
    });


    window.addEventListener("resize", function () {
        game.resize();
    });

    $('#tax_button').click(function () {
        selectedVehicle = "tax";
        console.log('taxi set')
        for (let user in game.sessionData["users"]) {
            if (game.sessionData["users"][user]["id"] == game.userId) {
                game.sessionData["users"][user]["lastUsedVehicle"] = selectedVehicle;
                var location = game.sessionData["users"][user]["location"];
            }
        }

 
        game.showPossibleMoves(location, selectedVehicle);
        

        //show possible moves for this vehicle

    })

    $('#bus_button').click(function () {
        selectedVehicle = "bus";
        console.log('bus set')
        for (let user in game.sessionData["users"]) {
            if (game.sessionData["users"][user]["id"] == game.userId) {
                game.sessionData["users"][user]["lastUsedVehicle"] = selectedVehicle;
            }
        }

    })

    $('#und_button').click(function () {
        selectedVehicle = "und";
        console.log('underground set')
        for (let user in game.sessionData["users"]) {
            if (game.sessionData["users"][user]["id"] == game.userId) {
                game.sessionData["users"][user]["lastUsedVehicle"] = selectedVehicle;
            }
        }
    })

    // $(".vehicle_buttons").click(function () {
    //     let vehicle = $(this).attr("id").replace("_button", "");
    //     if (game.submitCanBeDisabled) {
    //         $("#submit-move-button").removeAttr("disabled");
    //         $("#submit-move-button").removeClass("inactive-vehicle-button")
    //     }
    //     for (let user in game.sessionData["users"]) {
    //         if (game.sessionData["users"][user]["id"] == window.sessionStorage.getItem("userId")) {
    //             game.sessionData["users"][user]["lastUsedVehicle"] = vehicle;
    //         }
    //     }
    // });

    $("#submit-move-button").click(function (event) {

        event.preventDefault();
        for (let user in game.sessionData["users"]) {
            if (game.sessionData["users"][user]["id"] == window.sessionStorage.getItem("userId")) {
                if (game.sessionData["users"][user]["lastLocation"] == game.sessionData["users"][user]["location"]) {
                    useModal("Choose another position", "You cannot stay on the same position for two rounds in a row.", "Close")
                    return "";
                }
                let vehicleButtons = $('.vehicle_button_div > p');
                $(".vehicle_buttons").attr('disabled', true);
                switch (usedVehicle) {
                    case "tax":
                        game.sessionData["users"][user]["cardAmount"]["tax"] -= 1;
                        console.log("hoi");
                        vehicleButtons[0].innerHTML = '<p class="mb-0 text-white">' + data['users'][user]['cardAmount']['tax'] + '</p>';
                        break;
                    case "bus":
                        game.sessionData["users"][user]["cardAmount"]["bus"] -= 1;
                        vehicleButtons[1].innerHTML = '<p class="mb-0 text-white">' + data['users'][user]['cardAmount']['bus'] + '</p>';
                        break;

                    case "und":
                        game.sessionData["users"][user]["cardAmount"]["und"] -= 1;
                        vehicleButtons[2].innerHTML = '<p class="mb-0 text-white">' + data['users'][user]['cardAmount']['und'] + '</p>';
                        break;
                }



                let userData = game.sessionData["users"][user];
                $("#submit-move-button").addClass("inactive-vehicle-button")
                $("#submit-move-button").attr('disabled', true);
                $.ajax({
                    url: './scripts/make_move.php',
                    data: {
                        gameId: window.sessionStorage.getItem("gameId"),
                        userId: window.sessionStorage.getItem("userId"),
                        newUserInfo: JSON.stringify(userData)
                    },
                    type: 'POST'
                });

            }
        }
        // the changed information should be submitted so everyone will have the change

    });



});