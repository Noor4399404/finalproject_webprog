// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Working_with_Objects

class Game {
    
    constructor() {

        this.canvas = document.getElementById("gameCanvas");
        this.ctx = this.canvas.getContext("2d");
        
        this.backgroundSRC = "./images/game_board.jpg";

        this.canvas.width =  window.innerWidth * 0.97;
        this.canvas.height = window.innerHeight * 0.90;
        this.ratio = 1024 / 776; // Change to pixels of image

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

        this.clickSense = 3;
        
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

    getTriggers(triggerLocations) {

        this.triggerLocations = triggerLocations;

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
    
    }

    ScanForTrigger() {

        const location_list = Object.entries(this.triggerLocations);

        for (let location in location_list){
            //console.log(location_list[location]);
            for (let coordinate in location_list[location]){

                if (location_list[location][coordinate]["y"] !== 0.97) {

                    const topBoundary = (location_list[location][coordinate]["y"] * this.canvas.height) - this.clickSense;
                    const bottomBoundary = (location_list[location][coordinate]["y"] * this.canvas.height) + this.triggerSize["y"] + this.clickSense;
                    const leftBoundary = (location_list[location][coordinate]["x"] * this.canvas.width) - this.clickSense;
                    const rightBoundary = (location_list[location][coordinate]["x"] * this.canvas.width) + this.triggerSize["x"] + this.clickSense;

                    if (this.mouseX > leftBoundary && 
                        this.mouseX < rightBoundary &&
                        this.mouseY < bottomBoundary &&
                        this.mouseY > topBoundary) {

                        return location;
                    }
                }
            }
        }
    }

    showTriggers() {

        //higlights the triggers for dev purposes

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
        // 	"":{"x": ,"y": },

        const topLeft = {
            "x": (this.mouseX - (this.triggerSize["x"]/2)) / this.canvas.width,
            "y": (this.mouseY - (this.triggerSize["y"]/2)) / this.canvas.height
        }

        this.ctx.beginPath();
        this.ctx.rect(
            topLeft["x"] * this.canvas.width, topLeft["y"] * this.canvas.height, 
            this.triggerSize["x"], this.triggerSize["y"]
            );
        this.ctx.lineWidth = 1;
        this.ctx.strokeStyle = 'red';
        this.ctx.stroke();

        console.log(topLeft);

    }

}


$(function() {

    const canvas = document.getElementById("gameCanvas");

    var game = new Game();

    //gets trigger locations from json file
    var request = $.post("scripts/get_triggers.php", {call_now: "True"});
    request.done(function (data) {
        game.getTriggers(data);
        setTimeout(function(){
            game.showTriggers();
        }, 100);
        
    });



    canvas.addEventListener("click", function(event){
        
        game.getMousePosition(event);

        //game.triggerHelper();

        var trigger = game.ScanForTrigger();
        //console.log(trigger);

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