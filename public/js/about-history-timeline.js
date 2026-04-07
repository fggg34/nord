(function () {
    var root = document.getElementById('our-history');
    if (!root) return;

    var years = Array.from(root.querySelectorAll('.loginord-history__year'));
    var panes = Array.from(root.querySelectorAll('.loginord-history__pane'));
    var indicator = root.querySelector('.loginord-history__indicator');
    var total = years.length;
    if (!total) return;

    var active = -1;
    var ticking = false;

    function measureYearHeight() {
        if (!years[0]) return;
        root.style.setProperty('--h-year-h', years[0].offsetHeight + 'px');
    }

    function moveIndicator(idx) {
        if (!indicator || !years[idx]) return;
        var parentTop = years[idx].parentElement.getBoundingClientRect().top;
        var yearTop = years[idx].getBoundingClientRect().top;
        indicator.style.transform = 'translateY(' + (yearTop - parentTop) + 'px)';
    }

    function setActive(i) {
        var next = Math.max(0, Math.min(i, total - 1));
        if (next === active) return;
        active = next;

        years.forEach(function (y, j) {
            var on = j === active;
            y.classList.toggle('is-active', on);
            y.setAttribute('aria-selected', on ? 'true' : 'false');
        });

        panes.forEach(function (p, j) {
            var on = j === active;
            p.classList.toggle('is-active', on);
            if (on) {
                p.removeAttribute('hidden');
                p.setAttribute('aria-hidden', 'false');
            } else {
                p.setAttribute('hidden', '');
                p.setAttribute('aria-hidden', 'true');
            }
        });

        moveIndicator(active);
    }

    function tick() {
        ticking = false;
        var scrollable = root.offsetHeight - window.innerHeight;
        if (scrollable <= 0) return;

        var rect = root.getBoundingClientRect();
        var progress = Math.max(0, Math.min(1, -rect.top / scrollable));
        var idx = Math.min(Math.floor(progress * total), total - 1);
        setActive(idx);
    }

    function onScroll() {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(tick);
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });

    years.forEach(function (y) {
        y.addEventListener('click', function () {
            var i = Number(y.getAttribute('data-history-index'));
            if (isNaN(i) || i < 0 || i >= total) return;
            var scrollable = root.offsetHeight - window.innerHeight;
            var targetY = root.getBoundingClientRect().top + window.pageYOffset
                        + (scrollable * i / total);
            window.scrollTo({ top: targetY, behavior: 'smooth' });
        });
    });

    measureYearHeight();
    window.addEventListener('resize', function () {
        measureYearHeight();
        if (active >= 0) moveIndicator(active);
    });

    setActive(0);
})();
