const cnt = prompt("정수를 입력하세요.", "");
const star = document.querySelector(".star");

function printStar(n) {
    if(isNaN(parseInt(n))) {
        let error = document.createElement("P");
        error.innerHTML = "입력 오류 입니다.";
        star.appendChild(error);
    } else {
        for(let i = 1; i <= n; i++) {
            let line = document.createElement("DIV");
            for(let k = 1; k <= i; k++) {
                let pStar = document.createElement("SPAN");
                pStar.innerHTML = "*";
                line.appendChild(pStar);
            }
            star.appendChild(line);
        }
    }
}

printStar(cnt);