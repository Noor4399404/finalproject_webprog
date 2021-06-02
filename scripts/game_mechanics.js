class Game {
    
    constructor() {

        this.canvas = document.getElementById("gameCanvas");
        this.ctx = this.canvas.getContext("2d");
        
        this.backgroundSRC = "./images/gameBoard_medRes.JPG";

        this.canvas.width =  window.innerWidth * 0.97;
        this.canvas.height = window.innerHeight * 0.90;
        this.ratio = 4312 / 3256; // Change to pixels of image

        if (this.canvas.height < this.canvas.width / this.ratio){
            this.canvas.width = this.canvas.height * this.ratio;
        } else {
            this.canvas.height = this.canvas.width / this.ratio;
        }

        this.setBackground();

        this.triggerSize = {
            "x": this.canvas.width * 0.015,
            "y": this.canvas.height * 0.025
        };

        this.clickSense = this.canvas.width * 0.004;

        this.startingPositions = [13, 26, 29, 34, 50, 53, 94, 103, 112, 117, 132, 138, 141, 155, 174, 197, 198];
        this.startingPositions = this.startingPositions.sort(() => Math.random() - 0.5)

        this.sessionID = 950737;//window.sessionStorage.getItem("gameId");

    }

    setBackground() {

        //sets the background, with correct size

        var ctx = this.ctx;
        var canvas = this.canvas;

        var background = new Image();
        background.src = this.backgroundSRC;

        background.onload = function() {
            ctx.drawImage(
                background, 0, 0, 
                canvas.width,
                canvas.height);
        }
    }


    getHost() {

        const userId = 1234567;//window.sessionStorage.getItem("userId");

        for (var user in this.sessionData["users"]) {
            if (this.sessionData["users"][user]["id"] == userId){
                if (this.sessionData["users"][user]["isHost"] == "1"){
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

        if (this.isHost){
            this.detectiveAmount = Object.keys(this.sessionData["users"]).length - 1;
            for (var user in this.sessionData["users"]) {
                if (this.sessionData["users"][user]["isMisterX"] == '1'){
                    this.misterX = new MisterX();
                }
            }
        }
    }

    getMousePosition(event) {

        //sets mouseX and mouseY to most recent click

        var rect = this.canvas.getBoundingClientRect();
        this.mouseX = event.clientX - rect.left;
        this.mouseY = event.clientY - rect.top;

        //console.log("X: " + this.mouseX + "\tY: " + this.mouseY);
        
    }

    getTriggers(triggerLocations) {

        this.triggerLocations = triggerLocations;

    }

    getPossibleMoves(possibleMoves) {

        this.possibleMoves = possibleMoves;

    }

    getSessionData(sessionData) {

        for (var session in sessionData){
            if (this.sessionID == sessionData[session]["id"]){
                this.sessionData = sessionData[session];
            }
        }

        console.log(this.sessionData);

    }

    resize() {

        //makes sure the game looks correct with window resize

        this.canvas.width =  window.innerWidth * 0.97;
        this.canvas.height = window.innerHeight * 0.90;

        if (this.canvas.height < this.canvas.width / this.ratio){
            this.canvas.width = this.canvas.height * this.ratio;
        } else {
            this.canvas.height = this.canvas.width / this.ratio;
        }

        this.setBackground();

        this.clickSense = this.canvas.width * 0.004;

        this.triggerSize = {
            "x": this.canvas.width * 0.015,
            "y": this.canvas.height * 0.025
        };
    
    }

    scanForTrigger() {

        const location_list = Object.entries(this.triggerLocations);

        for (let location in location_list){
            //console.log(location_list[location]);
            for (let coordinate in location_list[location]){

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

        for (let location in location_list){
            //console.log(location_list[location]);
            for (let coordinate in location_list[location]){

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
            "x": (this.mouseX - (this.triggerSize["x"]/2)) / this.canvas.width,
            "y": (this.mouseY - (this.triggerSize["y"]/2)) / this.canvas.height
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

}


class Player {

    constructor() {

        this.location = game.startingPositions.pop();

    }

    movePlayerImage() {

    }

}

class Detective extends Player {

    constructor() {

        this.cardAmount = {
            "tax": 10,
            "bus": 8,
            "und": 4
        };

    }

    checkForMisterX(){

    }


}


class MisterX extends Player {

    constructor() {
        super();

    this.cardAmount = {
        "tax": 4,
        "bus": 3,
        "und": 3,
        "blck": game.detectiveAmount,
        "2x": 2
    };

    this.previousLocation

        
    }


}


$(function() {

    var game = new Game();

    var request = $.post("scripts/get_sessions.php", {call_now: "True"});
    request.done(function (data) {
            game.getSessionData(data);
            game.getHost();
            game.setupPlayers();
    });

    const canvas = document.getElementById("gameCanvas");

    //gets trigger locations from json file
    var request = $.post("scripts/get_triggers.php", {call_now: "True"});
    request.done(function (data) {
        game.getTriggers(data);
        
        //Shows the clickable areas on the game board 
        /*
        setTimeout(function(){
            game.showTriggers();
        }, 100);
        */
        
    });

    var request = $.post("scripts/get_possible_moves.php", {call_now: "True"});
    request.done(function (data) {
        game.getPossibleMoves(data);
    });


    canvas.addEventListener("click", function(event){
        
        game.getMousePosition(event);

        game.getStartingPosition();

        //The following copies the location of where you clicked in trigger_locations.json format
        //game.triggerHelper();

        var trigger = game.scanForTrigger();
        console.log(trigger);

    });


    window.addEventListener("resize", function(){
        game.resize();
    });

});