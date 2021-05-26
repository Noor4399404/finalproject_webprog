// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Working_with_Objects

class Game {
    
    constructor(trigger_locations, possible_moves) {

        this.canvas = document.getElementById("gameCanvas");
        this.ctx = this.canvas.getContext("2d");
        
        this.backgroundSRC = "./images/game_board.jpg";

        canvas.width =  window.innerWidth * 0.97;
        canvas.height = window.innerHeight * 0.90;
        this.ratio = 1024 / 776; // Change to pixels of image

        this.triggerSize = {
            "x": this.width * 0.015,
            "y": this.height * 0.025
        };
        this.clickSense = 3;

        this.setBackground();

        this.trigger_locations = trigger_locations;
        this.possible_moves = possible_moves;

        console.log(this.trigger_locations);

        // TODO: remove timeout
        //setTimeout(function(){
            //this.makeTriggers();
        //}, 500);
        
        //set up players
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

    getMousePosition(event) {

        //sets mouseX and mouseY to most recent click

        var rect = this.canvas.getBoundingClientRect();
        this.mouseX = event.clientX - rect.left;
        this.mouseY = event.clientY - rect.top;

        console.log("X: " + this.mouseX + "\tY: " + this.mouseY);
        
    }

    getTriggers() {

        //gets trigger locations from json file

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.addEventListener("load", function(){
            if (this.readyState == 4 && this.status == 200) {
                var trigger_locations = JSON.parse(this.responseText);
                //console.log(trigger_locations);
                //this.getTriggersHelper(trigger_locations);
            }
        });
        
        xmlhttp.open("GET", "./data/trigger_locations.json", true);
        xmlhttp.send();

        /*var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            
            if (this.readyState == 4 && this.status == 200) {
                var trigger_locations = JSON.parse(this.responseText);
                console.log(trigger_locations);
                return trigger_locations;
            }
        };
        
        xmlhttp.open("GET", "./data/trigger_locations.json", true);
        xmlhttp.send();*/

        //this.triggers.forEach(this.showTrigger);

    }

    getTriggersHelper(trigger_locations) {

        this.trigger_locations = trigger_locations;

    }

    resize() {

        //makes sure the game looks correct with window resize

        this.width =  window.innerWidth * 0.97;
        this.height = window.innerHeight * 0.90;

        if (this.height < this.width / this.ratio){
            this.width = this.height * this.ratio;
        } else {
            this.height = this.width / this.ratio;
        }

        this.setBackground();
        //this.makeTriggers();
    
    }

    showTrigger(trigger) {

        //higlights the triggers for dev purposes

        ctx.beginPath();
        ctx.rect(
            trigger["x"], trigger["y"], 
            this.triggerSize["x"], this.triggerSize["y"]
            );
        ctx.lineWidth = 1;
        ctx.strokeStyle = 'red';
        ctx.stroke();
    }

    triggerHelper() {

        //help make get trigger locations

        ctx.beginPath();
        ctx.rect(
            this.mouseX, this.mouseY, 
            this.triggerSize["x"], this.triggerSize["y"]
            );
        ctx.lineWidth = 1;
        ctx.strokeStyle = 'red';
        ctx.stroke();

    }

}


$(function() {

    var trigger_locations = {};
    var possible_moves = {};


    
    //get trigger locations
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            trigger_locations = JSON.parse(this.responseText);
            console.log(this.responseText);
            console.log(trigger_locations);
        }
    };
    xmlhttp.open("GET", "./data/trigger_locations.json", true);
    xmlhttp.send();

    //get possible moves
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            possible_moves = JSON.parse(this.responseText);
        }
    };
    xmlhttp.open("GET", "./data/possible_moves.json", true);
    xmlhttp.send();

    */
    const canvas = document.getElementById("gameCanvas");

    var game = new Game(trigger_locations, possible_moves);

    canvas.addEventListener("click", function(event){
        
        game.getMousePosition(event);

        //function to return the trigger number

    });

    window.addEventListener("resize", function(){

        game.resize();

    });

});


/*function resize_game(){

    var canvas = document.getElementById("game_canvas");
    var ctx = canvas.getContext("2d");

    var canvas_width = window.innerWidth * 0.97;
    var canvas_height = window.innerHeight * 0.90;

    let ratio = 1024 / 776; // Change to pixels of image
    
    if (canvas_height < canvas_width / ratio){
        canvas_width = canvas_height * ratio;
    } else {
        canvas_height = canvas_width / ratio;
    }

    canvas.width = canvas_width;
    canvas.height = canvas_height;

    set_background();

    make_triggers(canvas, ctx);

} */
