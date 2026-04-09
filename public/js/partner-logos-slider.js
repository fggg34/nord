(function () {
    var PER_PAGE = 6;

    function init(root) {
        var viewport = root.querySelector("[data-partner-viewport]");
        var track = root.querySelector("[data-partner-track]");
        var prev = root.querySelector("[data-partner-prev]");
        var next = root.querySelector("[data-partner-next]");
        if (!viewport || !track) return;
        var items = track.children;
        var n = items.length;
        var pages = Math.ceil(n / PER_PAGE);
        if (pages <= 1) return;

        var i = 0;

        function shift() {
            var w = viewport.offsetWidth;
            track.style.transform = "translateX(" + -i * w + "px)";
            if (prev) prev.disabled = i === 0;
            if (next) next.disabled = i >= pages - 1;
        }

        function go(idx) {
            i = Math.max(0, Math.min(pages - 1, idx));
            shift();
        }

        if (prev) prev.addEventListener("click", function () { go(i - 1); });
        if (next) next.addEventListener("click", function () { go(i + 1); });

        function bindResize() {
            shift();
        }
        if (typeof ResizeObserver !== "undefined") {
            var ro = new ResizeObserver(bindResize);
            ro.observe(viewport);
        } else {
            window.addEventListener("resize", bindResize);
        }

        go(0);
    }

    document.querySelectorAll("[data-partner-slider]").forEach(init);
})();
