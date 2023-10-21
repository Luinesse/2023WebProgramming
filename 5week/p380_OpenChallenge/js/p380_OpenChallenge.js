const one = document.getElementById("one");
const two = document.getElementById("two");
const three = document.getElementById("three");
const res = document.getElementById("res");
let oneIn = false, twoIn = false, threeIn = false;

function randNum(e) {
    switch(e.target.id) {
        case 'one' :
            if(!oneIn) {
                one.innerHTML = Math.floor(Math.random() * 3);
                oneIn = true;
            }
            break;
        case 'two' :
            if(!twoIn) {
                two.innerHTML = Math.floor(Math.random() * 3);
                twoIn = true;
            }
            break;
        case 'three' :
            if(!threeIn) {
                three.innerHTML = Math.floor(Math.random() * 3);
                threeIn = true;
            }
            break;
    }
    if(oneIn && twoIn && threeIn)    check();
}

function check() {
    if(one.innerHTML == two.innerHTML && two.innerHTML == three.innerHTML) {
        res.innerHTML = "Success(click here to do again)";
    } else {
        res.innerHTML = "fail(click here to do again)";
    }
}

function Init() {
    if(oneIn && twoIn && threeIn) {
        one.innerHTML = "0";
        two.innerHTML = "0";
        three.innerHTML = "0";
        oneIn = false;
        twoIn = false;
        threeIn = false;
        res.innerHTML = "";
    }
}
one.addEventListener('click', randNum);
two.addEventListener('click', randNum);
three.addEventListener('click', randNum);
res.addEventListener('click', Init);