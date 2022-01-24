window.addEventListener('load', (event) => {
    console.log('shuffle.js Copyright (c) 2022 claycle.com');
    var startProductBarPos = -1;
    //console.log("Today: {{ .Date }}, Title {{ site.Title }}");
});

window.addEventListener('load', (event) => {
    // Locate all the data-shuffle images
    let elements = document.querySelectorAll("[data-shuffle]");
    // Fetch an image for this shuffle
    // Images located with /images/shuffle 
    // .Resources.ByType "image" //
    // resources.Match "images/shuffle/*"
    let deck = [];
    {{ range resources.Match "images/shuffle/{*.jpg,*.png,*.webp}" }}
    deck.push("{{ .RelPermalink }}");
    {{ end }}
    let shuffled = [];
    
    // function shuffleArray(arr) {
    //   arr.sort(() => Math.random() - 0.5);
    // }
    
    elements.forEach(el => {
        //console.log(el);
        if (shuffled.length === 0) {
            shuffled = deck.slice().sort(() => Math.random() - 0.5);
        }
        // Pop the top element
        let i = shuffled.pop();
        el.src = i;
    });
});