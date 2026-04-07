<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CMS') — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cmsRepeater', (items, fields) => ({
                items: Array.isArray(items) ? JSON.parse(JSON.stringify(items)) : [],
                fields: Array.isArray(fields) ? fields : [],
                add() {
                    const row = {};
                    this.fields.forEach((f) => { row[f.key] = ''; });
                    this.items.push(row);
                },
                remove(i) {
                    this.items.splice(i, 1);
                },
            }));
        });
    </script>
    <style>
        :root {
            --cms-bg: #f1f5f9;
            --cms-surface: #ffffff;
            --cms-border: #e2e8f0;
            --cms-text: #0f172a;
            --cms-muted: #64748b;
            --cms-accent: #2563eb;
            --cms-accent-soft: #eff6ff;
            --cms-sidebar: #0f172a;
            --cms-sidebar-text: #e2e8f0;
            --cms-sidebar-muted: #94a3b8;
            --cms-radius: 12px;
            --cms-shadow: 0 1px 3px rgba(15, 23, 42, 0.06), 0 4px 12px rgba(15, 23, 42, 0.04);
        }
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'DM Sans', system-ui, sans-serif;
            font-size: 15px;
            line-height: 1.5;
            color: var(--cms-text);
            background: var(--cms-bg);
        }
        .cms-shell { display: flex; min-height: 100vh; }
        .cms-main { flex: 1; min-width: 0; padding: 1.75rem 2rem 3rem; }
        .cms-topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
        }
        .cms-topbar h1 {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 1.65rem;
            font-weight: 600;
            margin: 0 0 0.25rem;
            letter-spacing: -0.02em;
        }
        .cms-topbar p { margin: 0; color: var(--cms-muted); font-size: 0.9rem; }
        .cms-status {
            background: #ecfdf5;
            color: #047857;
            padding: 0.5rem 0.85rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .cms-nav-link {
            display: block;
            padding: 0.55rem 0.75rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--cms-sidebar-text);
            transition: background 0.15s;
        }
        .cms-nav-link:hover { background: rgba(148, 163, 184, 0.12); }
        .cms-nav-link.is-active {
            background: rgba(37, 99, 235, 0.28);
            color: #fff;
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="cms-shell">
    <x-admin.sidebar :pages="$pages ?? collect()" :active-page="$page ?? null" />
    <main class="cms-main">
        @yield('content')
    </main>
</div>
@stack('scripts')
</body>
</html>
