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
    };
})();
