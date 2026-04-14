(function () {
    function init(root) {
        var viewport = root.querySelector("[data-partner-viewport]");
        var track = root.querySelector("[data-partner-track]");
        var prev = root.querySelector("[data-partner-prev]");
        var next = root.querySelector("[data-partner-next]");
        if (!viewport || !track) return;
        var items = track.children;
        var n = items.length;
        if (n <= 1) return;

        var i = 0;

        function stepPx() {
            if (n < 2) return viewport.offsetWidth;
            return items[1].offsetLeft - items[0].offsetLeft;
        }

        function shift() {
            var step = stepPx();
            var maxOff = Math.max(0, track.scrollWidth - viewport.clientWidth);
            var maxI = step > 0 ? Math.ceil(maxOff / step) : 0;
            var off = Math.min(i * step, maxOff);
            track.style.transform = "translateX(" + -off + "px)";
            if (prev) prev.disabled = i === 0;
            if (next) next.disabled = i >= maxI;
        }

        function go(idx) {
            var step = stepPx();
            var maxOff = Math.max(0, track.scrollWidth - viewport.clientWidth);
            var maxI = step > 0 ? Math.ceil(maxOff / step) : 0;
            i = Math.max(0, Math.min(maxI, idx));
            shift();
        }

        if (prev) prev.addEventListener("click", function () { go(i - 1); });
        if (next) next.addEventListener("click", function () { go(i + 1); });

        function bindResize() {
            var step = stepPx();
            var maxOff = Math.max(0, track.scrollWidth - viewport.clientWidth);
            var maxI = step > 0 ? Math.ceil(maxOff / step) : 0;
            if (i > maxI) i = maxI;
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
