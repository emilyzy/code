const images = document.querySelectorAll(".images");
let  pagers = document.querySelectorAll(".pager-item");
const banner = document.querySelector("#banner-paper");
const l = images.length;
let z = 10;//表示层级
let now = 0;//默认第0张
let flag=true;
let t; //保存setInterval
let next;
for (let i = 0; i < l; i++) {
    pagers[i].onclick = function () {
        if (!flag) return;
        flag=false;
        for (let j = 0; j < l; j++) {
            pagers[j].classList.remove("active");
        }
        this.classList.add("active");
        if (i > now) {
            images[now].classList.add("leftOut");
            images[i].classList.add("leftIn");
        } else if (i < now) {
            images[now].classList.add("rightOut");
            images[i].classList.add("rightIn");
        }
        images[i].style.zIndex = z++;
        now = i;
    };
    images[i].addEventListener("animationend", function () {
        this.className = "images";
        flag=true;
    })
}
t=setInterval(move,5000);
function move() {
    next=now+1;
    if (next===l){
        next=0;
    }
    for (let j = 0; j < l; j++) {
        pagers[j].classList.remove("active");
    }
    pagers[next].classList.add("active");
    images[now].classList.add("leftOut");
    images[next].classList.add("leftIn");
    images[next].style.zIndex=z++;
    now=next;
}
banner.onmouseenter = function () {
    clearInterval(t);
};
banner.onmouseleave = function () {
    t = setInterval(move, 5000);
};
