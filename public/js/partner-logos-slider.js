(function () {
    function init(root) {
        var track = root.querySelector("[data-partner-track]");
        var prev = root.querySelector("[data-partner-prev]");
        var next = root.querySelector("[data-partner-next]");
        if (!track) return;
        var slides = track.children;
        var n = slides.length;
        if (n <= 1) return;
        var i = 0;
        function go(idx) {
            i = Math.max(0, Math.min(n - 1, idx));
            track.style.transform = "translateX(" + -i * 100 + "%)";
            if (prev) prev.disabled = i === 0;
            if (next) next.disabled = i === n - 1;
        }
        if (prev) prev.addEventListener("click", function () { go(i - 1); });
        if (next) next.addEventListener("click", function () { go(i + 1); });
        go(0);
    }
    document.querySelectorAll("[data-partner-slider]").forEach(init);
})();
