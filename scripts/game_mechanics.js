function make_canvas(){

    var canvas = $("#game_canvas");

    console.log(canvas);

    var ctx = canvas.getContext("2d");

    var background_image = document.createElement("img");
    background_image.setAttribute("src", "../images/game_board.jpg");

    ctx.drawImage(background_image, 10, 10);


    canvas.style = "width: 100%; height: auto;";
    canvas.style = "background: url('../images/game_board.jpg');";
    canvas.style = "background: red;";

}

function set_background(){

    var canvas = document.getElementById("game_canvas");
    var ctx = canvas.getContext("2d");

    // Add in background image (game board)
    const background = new Image();
    background.src = "images/game_board.jpg";

    background.onload = function(){
        ctx.drawImage(background, 0, 0, canvas.width, canvas.height);   
    }

}


function setup_game(){

    // Set up necessary variables
    var canvas = document.getElementById("game_canvas");
    var ctx = canvas.getContext("2d");

    // Give canvas a border (temporary)
    canvas.setAttribute("style", "border:2px solid #000000;");

    // Set window to correct size
    resize_game();

    add_triggers();

}

function resize_game(){

    var canvas = document.getElementById("game_canvas");

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

}

function place_triggers(){

    

}


$(function() {
    //make_canvas();
    setup_game();

    window.addEventListener("resize", function(){
        resize_game();
    });

});