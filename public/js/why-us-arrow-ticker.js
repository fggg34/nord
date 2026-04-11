/**
 * Fallback vertical marquee if the CSS keyframes are not applied (e.g. late overrides).
 */
(function () {
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        return;
    }

    function init() {
        var track = document.querySelector(
            "#main .framer-rofhq5-container .loginord-vertical-ticker-track"
        );
        if (!track) {
            return;
        }

        var cs = window.getComputedStyle(track);
        var anim = cs.animationName;
        if (anim && anim !== "none") {
            return;
        }

        var ul = track.querySelector("ul.loginord-vertical-ticker-ul");
        if (!ul) {
            return;
        }

        var y = null;
        var pxPerFrame = 0.35;

        function loop() {
            var half = ul.scrollHeight / 2;
            if (half <= 1) {
                requestAnimationFrame(loop);
                return;
            }
            if (y === null) {
                y = -half;
            }
            y += pxPerFrame;
            if (y >= 0) {
                y = -half;
            }
            track.style.setProperty("transform", "translate3d(0," + y + "px,0)", "important");
            requestAnimationFrame(loop);
        }

        track.style.animation = "none";
        requestAnimationFrame(loop);
    }

    function schedule() {
        setTimeout(init, 80);
    }

    if (document.readyState === "complete") {
        schedule();
    } else {
        window.addEventListener("load", schedule);
    }
})();
