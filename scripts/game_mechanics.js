class Game {

    constructor() {

        this.canvas = document.getElementById("gameCanvas");
        this.ctx = this.canvas.getContext("2d");

        this.backgroundSRC = "./images/gameBoard_medRes.JPG";

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

        this.setupCanvas();
        this.canvas_positions = this.canvas.getBoundingClientRect();
        this.addUserIcon();

        this.triggerSize = {
            "x": this.canvas.width * 0.015,
            "y": this.canvas.height * 0.025
        };

        this.clickSense = this.canvas.width * 0.004;

        this.startingPositions = [13, 26, 29, 34, 50, 53, 94, 103, 112, 117, 132, 138, 141, 155, 174, 197, 198];
        this.startingPositions = this.startingPositions.sort(() => Math.random() - 0.5)

    }

    setupCanvas() {

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
        // a icon will always be displayed above the canvas, but I place two icons. one of them is above the background.

    }

    addUserIcon() {
        let canvas_positions = this.canvas_positions;
        console.log(canvas_positions.top, canvas_positions.left);
        let userIcon = $('<img id="userIconImage") src="./images/icons/user_icon.svg" style="position: absolute;">')
        let x = 0.255513698630137;
        let y = 0.31398125755743655;
        x = x * this.canvas.width / devicePixelRatio + canvas_positions.left - 5
        y = y * this.canvas.height / devicePixelRatio + canvas_positions.top - 2
        $("body").append(userIcon)
        $("#userIconImage").css("top", y).css("left", x).css("z-index", 10)
    }

    resizeUserIcon() {
        let canvas_positions = this.canvas_positions
        let x = 0.255513698630137;
        let y = 0.31398125755743655;
        x = x * this.canvas.width / devicePixelRatio + canvas_positions.left - 5
        y = y * this.canvas.height / devicePixelRatio + canvas_positions.top - 2
        $("#userIconImage").css("top", y).css("left", x).css("z-index", 10)
    }

    moveUserIcon(x, y) {
        let canvas_positions = this.canvas_positions;
        x = x * this.canvas.width / devicePixelRatio + canvas_positions.left - 5
        y = y * this.canvas.height / devicePixelRatio + canvas_positions.top - 2
        $("#userIconImage").css("top", y).css("left", x).css("z-index", 10)
    }


    // updateUserIcon(stationNum) {
    //     let ctx = this.ctx
    //     let x, y = this.triggerLocations[stationNum];
    //     let userIcon = this.userIcon;
    //     userIcon.onload = function () {
    //         ctx.drawImage(
    //             userIcon, x * this.canvas.width, y * this.canvas.height,
    //             canvas.width / window.devicePixelRatio / 25,
    //             canvas.height / window.devicePixelRatio / 25);
    //     }
    // } does not work yet.


    getHost() {

        const userId = 1234567;//window.sessionStorage.getItem("userId");

        for (var user in this.sessionData["users"]) {
            if (this.sessionData["users"][user]["id"] == userId) {
                if (this.sessionData["users"][user]["isHost"] == "1") {
                    this.isHost = true;
                    console.log("you are the host")
                } else {
                    this.isHost = false;
                    console.log("you are not the host")
                }
            }
        }
    }


    setupPlayers() {

        if (this.isHost) {
            this.detectiveAmount = Object.keys(this.sessionData["users"]).length - 1;
            this.detectives = [];
            for (var user in this.sessionData["users"]) {
                if (this.sessionData["users"][user]["isMisterX"] == '1') {
                    this.misterX = new MisterX(
                        this,
                        this.sessionData["users"][user]["id"],
                        this.sessionData["users"][user]["username"],
                        this.sessionData["users"][user]["isHost"],
                    );
                } else {
                    this.detectives.push(new Detective(
                        this,
                        this.sessionData["users"][user]["id"],
                        this.sessionData["users"][user]["username"],
                        this.sessionData["users"][user]["isHost"]
                    ));
                }
            }
            console.log(this.misterX);
            console.log(this.detectives);
        }
    }


    updateSession() {

        var request = $.post("scripts/update_session.php", {
            call_now: "True",
            gameId: sessionStorage.getItem("gameId"),
            playerId: this.id,
            username: this.username,
            cardAmount: this.cardAmount,
            location: this.location,
            previousLocation: this.previousLocation,
            myTurn: this.myTurn,
            hasMoved: this.hasMoved
        });
        request.done(function (data) {
            console.log(data)
        });

    }

    getMousePosition(event) {

        //sets mouseX and mouseY to most recent click

        var rect = this.canvas.getBoundingClientRect();
        this.mouseX = event.clientX * devicePixelRatio - rect.left * devicePixelRatio;
        this.mouseY = event.clientY * devicePixelRatio - rect.top * devicePixelRatio;

        //console.log("X: " + this.mouseX + "\tY: " + this.mouseY);

    }

    getTriggers(triggerLocations) {

        this.triggerLocations = triggerLocations;

    }

    getPossibleMoves(possibleMoves) {

        this.possibleMoves = possibleMoves;

    }

    getSessionData(sessionData) {

        this.sessionData = JSON.parse(sessionData);
        console.log(this.sessionData);

    }

    resize() {

        //makes sure the game looks correct with window resize

        this.canvas.width = window.innerWidth * 0.97 * devicePixelRatio;
        this.canvas.height = window.innerHeight * 0.90 * devicePixelRatio;

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

        this.setupCanvas();
        this.canvas_positions = this.canvas.getBoundingClientRect();
        this.resizeUserIcon();

        this.clickSense = this.canvas.width * 0.004;

        this.triggerSize = {
            "x": this.canvas.width * 0.015,
            "y": this.canvas.height * 0.025
        };

    }

    scanForTrigger() {

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

    checkForMisterX() {

    }

}


class Player {

    constructor(game, playerId, username, isHost) {

        this.id = playerId;
        this.username = username;
        this.isHost = isHost;
        this.location = game.startingPositions.pop();
        this.previousLocation = 0;

    }

    updateData() {

        var request = $.post("scripts/update_player.php", {
            call_now: "True",
            gameId: sessionStorage.getItem("gameId"),
            playerId: this.id,
            username: this.username,
            cardAmount: this.cardAmount,
            location: this.location,
            previousLocation: this.previousLocation,
            myTurn: this.myTurn,
            hasMoved: this.hasMoved
        });
        request.done(function (data) {
            console.log(data)
        });

    }

    /*

[
    {
        "id": 1234567,
        "users": [
            {
                "id": 1234567,
                "username": "oscar",
                "isHost": "1",
                "isMisterX": "",
                "cardAmount":{"tax":""},
                "myTurn": true,
                "hasMoved": false,
                "location": "startinglocation"
            },
            {
                "id": 2345678,
                "username": "bjorn",
                "isHost": "",
                "isMisterX": ""
            },
            {
                "id": 2398498,
                "username": "noor",
                "isHost": "",
                "isMisterX": "1"
            },
            {
                "id": 9872348,
                "username": "dennis",
                "isHost": "",
                "isMisterX": ""
            }

        ],
        "gameStarted": true
    }
]

    */

    movePlayerImage() {



    }



}

class Detective extends Player {

    constructor(game, playerId, username, isHost) {
        super(game, playerId, username, isHost);

        this.cardAmount = {
            "tax": 10,
            "bus": 8,
            "und": 4
        };

        this.myTurn = false;
        this.hasMoved = false;

        this.updateData();

    }

}


class MisterX extends Player {

    constructor(game, playerId, username, isHost) {
        super(game, playerId, username, isHost);

        this.cardAmount = {
            "tax": 4,
            "bus": 3,
            "und": 3,
            "blck": game.detectiveAmount,
            "2x": 2
        };

        this.myTurn = true;
        this.hasMoved = false;

        this.updateData();

    }

}


$(function () {

    var game = new Game();

    var request = $.post("scripts/get_session.php", {
        call_now: "True",
        gameId: 950737 //sessionStorage.getItem("gameId")
    });
    request.done(function (data) {
        console.log(data);
        game.sessionData = data
        // game.getSessionData(data); is not necessary if you make the header inside php json.
        game.getHost();
        game.setupPlayers();
    });


    const canvas = document.getElementById("gameCanvas");

    //gets trigger locations from json file
    var request = $.post("scripts/get_triggers.php", { call_now: "True" });
    request.done(function (data) {
        game.getTriggers(data);
        $("#test-moving-button").click(function() {
            let randomInt = Math.floor((Math.random() * 200) + 1);
            console.log(randomInt);
            let x = data[randomInt]["x"]
            let y = data[randomInt]["y"]
            game.moveUserIcon(x, y)

        });
        

        //Shows the clickable areas on the game board 
        /*
        setTimeout(function(){
            game.showTriggers();
        }, 100);
        */

    });

    var request = $.post("scripts/get_possible_moves.php", { call_now: "True" });
    request.done(function (data) {
        game.getPossibleMoves(data);
    });


    canvas.addEventListener("click", function (event) {

        game.getMousePosition(event);

        //The following copies the location of where you clicked in trigger_locations.json format
        //game.triggerHelper();

        var trigger = game.scanForTrigger();
        console.log(trigger);

    });


    window.addEventListener("resize", function () {
        game.resize();
    });

});