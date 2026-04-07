
<div class="search-container">
<h1>{{ content('search', 'general', 'h1_search') ?? "Search" }}</h1>
<input type="search" id="q" placeholder="Search pages..." autofocus>
<div class="results" id="results"></div>
</div>
<script>
(function() {
var pages = [{"path":"/","title":"Loginord | Framer Template for Transport &amp; Logistics Companies","description":"Professional Framer website template for logistics and transport businesses. Services, About &amp; Team, Fleet, &amp; Industry-ready sections. Launch fast and make a statement with our present and future clients.","excerpt":"Industries"},{"path":"/404","title":"404 Not Found – Loginord Framer Template","description":"Oops! Page not found. A custom 404 page designed within the Loginord Framer website template for logistics and transport companies.","excerpt":"Industries"},{"path":"/about-us","title":"About Loginord – Transport &amp; Logistics Framer Website Template","description":"Discover the Loginord About page, a modern Framer website template for transport and logistics companies. Perfect for showcasing your company","excerpt":"Industries"},{"path":"/contact-us","title":"Contact Page – Framer Template for Transport &amp; Logistics Companies","description":"Easily customizable contact page from the Loginord Framer template. Built for transport and logistics businesses to connect with potential clients or partners. Built with a Contact Form.","excerpt":"Industries"},{"path":"/industries","title":"Industries We Serve – Transport &amp; Logistics Template in Framer","description":"Highlight the industries your company supports using this dedicated page from the Loginord Framer template. You may easily adapt the predefined Industries to the ones you need.","excerpt":"Industries"},{"path":"/our-fleet","title":"Fleet Showcase – Framer Website Template for Logistics Businesses","description":"Showcase your transport fleet with this professional page of the Loginord Framer template. Built to impress logistics companies needing a strong online presence.","excerpt":"Industries"},{"path":"/privacy-policy","title":"Privacy Policy – Loginord Framer Template","description":"View the default privacy policy page included with the Loginord Framer template. Customizable for logistics and transport company websites.","excerpt":"Industries"},{"path":"/services","title":"Transport &amp; Logistics Services – Framer Template for B2B Businesses","description":"Explore the services section of the Loginord Framer template, designed for transport and logistics providers. Ideal to present offerings like freight, warehousing, and distribution.","excerpt":"Industries"}];
var input = document.getElementById('q');
var resultsEl = document.getElementById('results');

function search(query) {
    if (!query || query.length < 2) { resultsEl.innerHTML = ''; return; }
    var q = query.toLowerCase();
    var matches = pages.filter(function(p) {
        return (p.title && p.title.toLowerCase().indexOf(q) !== -1) ||
               (p.description && p.description.toLowerCase().indexOf(q) !== -1) ||
               (p.excerpt && p.excerpt.toLowerCase().indexOf(q) !== -1);
    });
    if (matches.length === 0) {
        resultsEl.innerHTML = '<div class="no-results">No results found.</div>';
        return;
    }
    var html = '<div class="count">' + matches.length + ' result(s)</div>';
    matches.forEach(function(p) {
        var href = p.path === '/' ? '/' : p.path;
        html += '<a class="result-item" href="' + href + '">' +
            '<div class="result-title">' + esc(p.title || 'Untitled') + '</div>' +
            '<div class="result-path">' + esc(p.path) + '</div>' +
            '<div class="result-excerpt">' + esc(p.excerpt || p.description || '') + '</div>' +
            '</a>';
    });
    resultsEl.innerHTML = html;
}

function esc(s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }

input.addEventListener('input', function() { search(this.value); });
})();
</script>

