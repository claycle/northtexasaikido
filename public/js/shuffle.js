(() => {
  // <stdin>
  window.addEventListener("load", (event) => {
    console.log("shuffle.js Copyright (c) 2022 claycle.com");
    var startProductBarPos = -1;
  });
  window.addEventListener("load", (event) => {
    let elements = document.querySelectorAll("[data-shuffle]");
    const deck = [
      "/image/shuffle/Bokken 1x1 500w.jpg",
      "/image/shuffle/Dojo Seiza 1x1 500w.jpg",
      "/image/shuffle/erin fall 1x1 500w.jpg",
      "/image/shuffle/Jim Bokken 1x1 500w.jpg",
      "/image/shuffle/Jim Throw 1x1 500w.jpg",
      "/image/shuffle/Keiko Bokken 1x1 500w.jpg",
      "/image/shuffle/Keith Award 1x1 500w.jpg",
      "/image/shuffle/Keith Ian 1x1 500w.jpg",
      "/image/shuffle/Keith Ian 2 1x1 500w.jpg",
      "/image/shuffle/Mike S MDKH 1x1 500w.jpg",
      "/image/shuffle/Nina Award 1x1 500w.jpg",
      "/image/shuffle/Paden and Mike Sealock 1x1 500w.jpg",
      "/image/shuffle/Paden Jo 1x1 500w.jpg",
      "/image/shuffle/RAS KF Bokken 1x1 500w.jpg",
      "/image/shuffle/RAS Smile Throw 1x1 500w.jpg",
      "/image/shuffle/RASKF1x1500w.jpg",
      "/image/shuffle/Throw 1x1 500w.jpg"
    ];
    let shuffled = [];
    elements.forEach((el) => {
      if (shuffled.length === 0) {
        shuffled = deck.slice().sort(() => Math.random() - 0.5);
      }
      let i = shuffled.pop();
      el.src = i;
    });
  });
})();
