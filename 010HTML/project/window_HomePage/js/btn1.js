/*第一种方法
const btn1s = document.querySelectorAll(".btn1");
const box = document.querySelector("#big-box");
const mousebody1 = document.querySelector("#mousebody1");
const l = btn1s.length;
let n = 0;
for (let i = 0; i < l; i++) {
    btn1s[i].onclick = function () {
        for (let j = 0; j < l; j++) {
            btn1s[j].classList.remove("btn1-active");
        }
        this.classList.add("btn1-active");
        box.style.marginLeft = -i * 1440 + "px";
        n = i;
        /!*console.log(box);*!/
    }
}
/!*添加自动轮播效果*!/
let t;
t = setInterval(move, 5000);

function move() {
    n++;
    if (n === 4) {
        n = 0;
    }
    for (let j = 0; j < l; j++) {
        btn1s[j].classList.remove("btn1-active");
    }
    btn1s[n].classList.add("btn1-active");
    box.style.marginLeft = -n * 1440 + "px";
}

/!*添加鼠标事件*!/
mousebody1.onmouseenter = function () {
    clearInterval(t);
};
mousebody1.onmouseleave = function () {
    t = setInterval(move, 5000);
};*/

/*第二种方法*/
const images = document.querySelectorAll(".images");
let  pagers = document.querySelectorAll(".btn1");
const banner = document.querySelector("#mousebody1");
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
            pagers[j].classList.remove("active1");
        }
        this.classList.add("active1");
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
        pagers[j].classList.remove("active1");
    }
    pagers[next].classList.add("active1");
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
