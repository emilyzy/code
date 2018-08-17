let images = document.querySelectorAll(".image");
let btns = document.querySelectorAll(".btn");
let contain = document.querySelector(".header-banner");
let l = btns.length;
let t;
let n = 0;
let now = 0;
let z = 10;

for (let i = 0; i < l; i++) {
    btns[i].onclick = function () {
        for (let j = 0; j < l; j++) {
            btns[j].classList.remove("active");
        }
        btns[i].classList.add("active");
        if (i > now) {
             images[now].classList.add("left-out");
            images[i].classList.add("left-in");

        } else if (i < now) {
            images[now].classList.add("right-out");
            images[i].classList.add("right-in");
        }
        images[i].style.zIndex = z++;
        now = i;

    };

    images[i].addEventListener("animationend", function () {
            this.className = "image";
    })
}

function move() {
    n=now+1;
    if (n === l) {
        n = 0;
    }
    for (let i = 0; i < l; i++) {
        btns[i].classList.remove("active");
    }
    btns[n].classList.add("active");
    images[now].classList.add("left-out");
       images[n].classList.add("left-in");
       images[n].style.zIndex=z++;
       now=n;
}
t = setInterval(move, 3000);
console.log(t);
contain.onmouseenter = function () {
    clearInterval(t);
};
contain.onmouseleave = function () {
    t = setInterval(move, 3000);
};

