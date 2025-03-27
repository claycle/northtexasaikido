(() => {
  // <stdin>
  var startProductBarPos = -1;
  function findPosY(obj) {
    if (!obj) return 0;
    var curtop = 0;
    if (obj.offsetParent) {
      while (obj.offsetParent) {
        curtop += obj.offsetTop;
        obj = obj.offsetParent;
      }
      curtop += obj.offsetTop;
    } else if (obj.y)
      curtop += obj.y;
    return curtop;
  }
  window.addEventListener("scroll", (event) => {
    var bar = document.getElementById("thenavbar");
    if (bar === null) {
      console.log("thenavbar not assigned");
      return;
    }
    if (startProductBarPos < 0) startProductBarPos = findPosY(bar);
    if (
      /*pageYOffset*/
      scrollY > startProductBarPos
    ) {
      bar.classList.add("fixed-top");
      bar.classList.add("stucky");
      bar.classList.remove("unstucky");
    } else {
      bar.classList.remove("fixed-top");
      bar.classList.remove("stucky");
      bar.classList.add("unstucky");
    }
  });
  window.addEventListener("load", (event) => {
    console.log("navbar.js Copyright (c) 2022 claycle.com");
    var startProductBarPos2 = -1;
  });
})();
