const title = document.getElementById('titleName');
const image = document.getElementById('titleImage');

function mouseUp() {
    image.src = "../image.jpg";
}

function mouseDown() {
    image.src = "";
}

title.addEventListener("mouseover",mouseUp);
title.addEventListener("mouseout",mouseDown);