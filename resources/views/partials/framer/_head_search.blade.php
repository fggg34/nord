
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@include('partials.seo-head', [
    'page' => 'search',
    'defaultTitle' => 'Site Search',
    'defaultDescription' => 'Search pages and content on this site.',
    'defaultOgImage' => '/assets/images/95221dd86b926b19-TUsk3ygy6f75eOtFugQRJAXcjFY.jpg',
])
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f8f9fa; color: #1a1a2e; padding: 2rem; }
.search-container { max-width: 640px; margin: 0 auto; }
h1 { font-size: 1.5rem; margin-bottom: 1rem; }
input[type="search"] { width: 100%; padding: 0.75rem 1rem; font-size: 1rem; border: 2px solid #e2e8f0; border-radius: 8px; outline: none; transition: border-color 0.2s; }
input[type="search"]:focus { border-color: #6366f1; }
.results { margin-top: 1.5rem; }
.result-item { background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1rem; margin-bottom: 0.75rem; text-decoration: none; display: block; color: inherit; transition: box-shadow 0.2s; }
.result-item:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
.result-title { font-weight: 600; color: #4f46e5; margin-bottom: 0.25rem; }
.result-path { font-size: 0.8rem; color: #64748b; margin-bottom: 0.25rem; }
.result-excerpt { font-size: 0.9rem; color: #475569; }
.no-results { color: #94a3b8; text-align: center; padding: 2rem 0; }
.count { font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.75rem; }
</style>

