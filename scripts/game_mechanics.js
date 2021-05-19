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

$(function() {
    make_canvas();
});