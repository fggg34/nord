/**
 * Framer-style animated titles: word nowrap groups + letter spans (data-nce-scroll).
 * Loaded synchronously at the start of <body>; each title calls
 * __cmsFramerSplitBuildAdjacent(placeholder) inline right after its placeholder
 * so letters exist before later Framer / NoCode Export scripts run.
 */
(function () {
    'use strict';

    var LETTER_STYLE = 'display: inline-block; opacity:0; transform:translateY(40px); will-change: transform;';

    function buildWordCharSpans(root, text) {
        if (!root || text == null) {
            return;
        }

        while (root.firstChild) {
            root.removeChild(root.firstChild);
        }

        var words = String(text).split(/(\s+)/);

        words.forEach(function (token) {
            if (!token) {
                return;
            }

            if (/^\s+$/.test(token)) {
                root.appendChild(document.createTextNode(token));

                return;
            }

            var wordWrap = document.createElement('span');

            wordWrap.setAttribute('style', 'white-space:nowrap');

            Array.from(token).forEach(function (ch) {
                var sp = document.createElement('span');

                sp.setAttribute('style', LETTER_STYLE);
                sp.setAttribute('data-nce-scroll', 'true');
                sp.setAttribute('data-nce-initial-transform', 'translateY(40px)');
                sp.textContent = ch;
                wordWrap.appendChild(sp);
            });

            root.appendChild(wordWrap);
        });
    }

    /** Let the inline nce-scroll polyfill (loaded later in the page) observe new nodes. */
    function pingScrollPolyfill() {
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                if (typeof window.dispatchEvent === 'function') {
                    window.dispatchEvent(new Event('resize'));
                }
            });
        });
    }

    /**
     * If IntersectionObserver / visibility checks never run (hidden breakpoint, zero layout, etc.),
     * letters stay at opacity 0. Reveal any still-hidden spans after the polyfill had time to run.
     */
    function scheduleRevealFallback(root) {
        window.setTimeout(function () {
            if (!root || !root.querySelectorAll) {
                return;
            }
            root.querySelectorAll('[data-nce-scroll]').forEach(function (el) {
                if (el.hasAttribute('data-nce-scroll-revealed')) {
                    return;
                }
                if (el.hasAttribute('data-nce-scroll-animating')) {
                    return;
                }
                var op = parseFloat(window.getComputedStyle(el).opacity || '0');
                if (op < 0.05) {
                    el.style.opacity = '1';
                    el.style.transform = 'none';
                    el.style.webkitFilter = 'none';
                    el.style.filter = 'none';
                    el.setAttribute('data-nce-scroll-revealed', 'true');
                }
            });
        }, 700);
    }

    window.__cmsFramerSplitBuildAdjacent = function (root) {
        if (!root || !root.getAttribute) {
            return;
        }

        var text = root.getAttribute('data-cms-text');

        if (text === null) {
            return;
        }

        root.removeAttribute('data-cms-text');
        buildWordCharSpans(root, text);
        pingScrollPolyfill();
        scheduleRevealFallback(root);
    };
})();
