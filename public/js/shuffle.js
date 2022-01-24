(() => {
  // <stdin>
  window.addEventListener("load", (event) => {
    console.log("shuffle.js Copyright (c) 2022 claycle.com");
    var startProductBarPos = -1;
  });
  window.addEventListener("load", (event) => {
    let elements = document.querySelectorAll("[data-shuffle]");
    let deck = [];
    deck.push("/images/shuffle/Bokken%201x1%20500w.jpg");
    deck.push("/images/shuffle/Dojo%20Seiza%201x1%20500w.jpg");
    deck.push("/images/shuffle/Jim%20Bokken%201x1%20500w.jpg");
    deck.push("/images/shuffle/Jim%20Throw%201x1%20500w.jpg");
    deck.push("/images/shuffle/Keiko%20Bokken%201x1%20500w.jpg");
    deck.push("/images/shuffle/Keith%20Award%201x1%20500w.jpg");
    deck.push("/images/shuffle/Keith%20Ian%201x1%20500w.jpg");
    deck.push("/images/shuffle/Keith%20Ian%202%201x1%20500w.jpg");
    deck.push("/images/shuffle/Mike%20S%20MDKH%201x1%20500w.jpg");
    deck.push("/images/shuffle/Nina%20Award%201x1%20500w.jpg");
    deck.push("/images/shuffle/Paden%20Jo%201x1%20500w.jpg");
    deck.push("/images/shuffle/Paden%20and%20Mike%20Sealock%201x1%20500w.jpg");
    deck.push("/images/shuffle/RAS%20KF%20Bokken%201x1%20500w.jpg");
    deck.push("/images/shuffle/RAS%20Smile%20Throw%201x1%20500w.jpg");
    deck.push("/images/shuffle/RASKF1x1500w.jpg");
    deck.push("/images/shuffle/Throw%201x1%20500w.jpg");
    deck.push("/images/shuffle/erin%20fall%201x1%20500w.jpg");
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
