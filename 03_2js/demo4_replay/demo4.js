const btns = document.querySelectorAll(".btn");
const bottom = document.querySelector("#bottom");
const l = btns.length;
const container = document.querySelector("#container");
for (let i = 0; i < l; i++) {
    btns[i].onclick = function () {
        for (let j = 0; j < l; j++) {
            btns[j].classList.remove("active");
        }
        this.classList.add("active");
        bottom.style.marginLeft = -i * 800 + "px";
    }
}

let n = 0;
let t;
t = setInterval(function move() {
    n++;
    if (n === 4) {
        n = 0;
    }
    for (let j = 0; j < l; j++) {
        btns[j].classList.remove("active");
    }
    btns[n].classList.add("active");
    bottom.style.marginLeft = -n * 800 + "px";
}, 3000);

console.log(container);
container.onmouseenter = function () {
    /*console.log(1)*/
    clearInterval(t);
};
container.onmouseleave = function () {
    t=setInterval(function move(){
        n++;
        if(n===4){
            n=0;
        }
        for (let j=0;j<l;j++){
            btns[j].classList.remove("active");
        }
        btns[n].classList.add("active");
        bottom.style.marginLeft = -n * 800 + "px";
    },3000);
};
