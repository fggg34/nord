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
            Alpine.data('cmsRepeater', (items, fields, publicStoragePrefix) => ({
                items: Array.isArray(items) ? JSON.parse(JSON.stringify(items)) : [],
                fields: Array.isArray(fields) ? fields : [],
                publicStoragePrefix: typeof publicStoragePrefix === 'string' ? publicStoragePrefix : '',
                storageSrc(path) {
                    const p = (path || '').trim();
                    if (!p || p.startsWith('http://') || p.startsWith('https://') || p.startsWith('/')) {
                        return p;
                    }
                    return this.publicStoragePrefix + p.replace(/^\/+/, '');
                },
                isVideoPath(path) {
                    const p = (path || '').trim().toLowerCase();
                    return /\.(mp4|webm|mov|ogv|m4v)(\?|#|$)/.test(p);
                },
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

        /* Media fields: upload + remove (flat + repeater) */
        .cms-media-field {
            width: 100%;
            max-width: 32rem;
            border: 1px solid var(--cms-border);
            border-radius: 12px;
            background: var(--cms-surface);
            overflow: hidden;
            box-shadow: var(--cms-shadow);
        }
        .cms-media-field--pending-clear {
            border-color: #f59e0b;
            box-shadow: 0 0 0 1px rgba(245, 158, 11, 0.25);
        }
        .cms-media-preview-wrap {
            background: #f8fafc;
            border-bottom: 1px solid var(--cms-border);
        }
        .cms-media-field--pending-clear .cms-media-preview-wrap {
            opacity: 0.45;
            filter: grayscale(0.85);
        }
        .cms-media-preview-wrap img,
        .cms-media-preview-wrap video {
            display: block;
            max-width: 100%;
            max-height: 220px;
            width: 100%;
            object-fit: cover;
        }
        .cms-media-preview-wrap--empty {
            padding: 1.25rem 1rem;
            font-size: 0.875rem;
            color: var(--cms-muted);
        }
        .cms-media-toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.65rem;
            padding: 0.85rem 1rem;
        }
        .cms-media-toolbar input[type="file"] {
            font-size: 0.8rem;
            max-width: 100%;
        }
        .cms-btn-remove-media {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.45rem 0.85rem;
            font-size: 0.8125rem;
            font-weight: 600;
            font-family: inherit;
            color: #b91c1c;
            background: #fff;
            border: 1px solid #fecaca;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
        }
        .cms-btn-remove-media:hover {
            background: #fef2f2;
            border-color: #f87171;
        }
        .cms-btn-remove-media svg {
            flex-shrink: 0;
            opacity: 0.9;
        }
        .cms-media-clear-banner {
            display: none;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin: 0 1rem 0.85rem;
            padding: 0.55rem 0.75rem;
            font-size: 0.8125rem;
            color: #92400e;
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 8px;
        }
        .cms-media-field--pending-clear .cms-media-clear-banner {
            display: flex;
        }
        .cms-btn-undo-clear {
            padding: 0.25rem 0.6rem;
            font-size: 0.8125rem;
            font-weight: 600;
            font-family: inherit;
            color: var(--cms-accent);
            background: #fff;
            border: 1px solid var(--cms-border);
            border-radius: 6px;
            cursor: pointer;
        }
        .cms-btn-undo-clear:hover {
            background: var(--cms-accent-soft);
        }
        .cms-media-help {
            margin: 0 1rem 1rem;
            font-size: 0.75rem;
            color: var(--cms-muted);
            line-height: 1.45;
        }

        .cms-rep-media-card {
            border: 1px solid var(--cms-border);
            border-radius: 10px;
            background: #fafafa;
            padding: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }
        .cms-rep-media-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem;
        }
        .cms-rep-media-stack {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .cms-rep-media-preview {
            min-height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: flex-start;
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
<script>
(function () {
    document.addEventListener('click', function (e) {
        var removeBtn = e.target.closest('[data-cms-remove-media]');
        if (removeBtn) {
            e.preventDefault();
            var row = removeBtn.closest('[data-cms-media-row]');
            if (!row) return;
            row.classList.add('cms-media-field--pending-clear');
            var input = row.querySelector('.cms-clear-file-input');
            if (input) input.removeAttribute('disabled');
            return;
        }
        var undoBtn = e.target.closest('[data-cms-undo-clear]');
        if (undoBtn) {
            e.preventDefault();
            var row2 = undoBtn.closest('[data-cms-media-row]');
            if (!row2) return;
            row2.classList.remove('cms-media-field--pending-clear');
            var input2 = row2.querySelector('.cms-clear-file-input');
            if (input2) input2.setAttribute('disabled', 'disabled');
        }
    });
})();
</script>
</body>
</html>
