(function () {
    function bind(root) {
        if (!root || root.dataset.fleetAccordionInit === '1') return;
        root.dataset.fleetAccordionInit = '1';

        root.addEventListener('click', function (e) {
            var card = e.target.closest('.framer-1dyiqbv-container');
            if (!card || !root.contains(card)) return;

            var isCloseBtn = e.target.closest('.framer-ntvsza-container');

            if (e.target.closest('a[href]')) return;

            if (isCloseBtn && !card.classList.contains('fleet-card-collapsed')) {
                e.preventDefault();
                e.stopPropagation();
                card.classList.add('fleet-card-collapsed');
                return;
            }

            if (card.classList.contains('fleet-card-collapsed')) {
                root.querySelectorAll('.framer-1dyiqbv-container').forEach(function (c) {
                    c.classList.add('fleet-card-collapsed');
                });
                card.classList.remove('fleet-card-collapsed');
            }
        });
    }

    function run() {
        document.querySelectorAll('.framer-8sf16o').forEach(bind);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', run);
    } else {
        run();
    }
})();
