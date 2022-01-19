/* 
* Navbar Foo 
* We want to be able to have the navbar "pop" out and stick when scrolled to the top.
* This requires a little fine control.
*/

var startProductBarPos = -1;

function findPosY(obj) {
    //console.log("findPosY", obj);
    if (!obj) return 0;
    var curtop = 0;
    if (obj.offsetParent) {
        while (obj.offsetParent) {
            curtop += obj.offsetTop;
            obj = obj.offsetParent;
        }
        curtop += obj.offsetTop;
    }
    else if (obj.y)
        curtop += obj.y;
    return curtop;
}

window.addEventListener('scroll', (event) => {
    var bar = document.getElementById('thenavbar');
    if (bar === null) { console.log("thenavbar not assigned"); return; }
    //var barc = document.getElementById('thenavbarc');
    //console.log("Scroll Navbar", bar);
    if (startProductBarPos < 0) startProductBarPos = findPosY(bar);

    if (/*pageYOffset*/ scrollY > startProductBarPos) {
        bar.classList.add('fixed-top');
        bar.classList.add('stucky');
        bar.classList.remove('unstucky');
       // barc.classList.add('container-fluid');
       // barc.classList.remove('container');
    } else {
        bar.classList.remove('fixed-top');
        bar.classList.remove('stucky');
        bar.classList.add('unstucky');
        //barc.classList.add('container');
        //barc.classList.remove('container-fluid');
    }
});

window.addEventListener('load', (event) => {
    console.log('navbar.js Copyright (c) 2022 claycle.com');
    var startProductBarPos = -1;
});
