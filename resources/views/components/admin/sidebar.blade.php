@props([
    'pages' => collect(),
    'activePage' => null,
])

<aside style="width: 260px; flex-shrink: 0; background: var(--cms-sidebar); color: var(--cms-sidebar-text); display: flex; flex-direction: column; min-height: 100vh;">
    <div style="padding: 1.5rem 1.25rem 1.25rem; border-bottom: 1px solid rgba(148,163,184,0.15);">
        <div style="font-family: 'Fraunces', Georgia, serif; font-size: 1.15rem; font-weight: 600;">Site CMS</div>
        <div style="font-size: 0.75rem; color: var(--cms-sidebar-muted); margin-top: 0.25rem;">Content by page</div>
    </div>
    <nav style="flex: 1; padding: 1rem 0.75rem; overflow-y: auto;">
        <div style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--cms-sidebar-muted); padding: 0 0.75rem 0.5rem;">Pages</div>
        <ul style="list-style: none; margin: 0; padding: 0;">
            @foreach ($pages as $p)
                @php $slug = $p['slug'] ?? ''; @endphp
                <li style="margin-bottom: 2px;">
                    <a href="{{ route('admin.pages.edit', ['page' => $slug]) }}"
                       class="cms-nav-link {{ $activePage === $slug ? 'is-active' : '' }}">{{ $p['label'] ?? $slug }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
    <div style="padding: 1rem 1.25rem; border-top: 1px solid rgba(148,163,184,0.15);">
        <form method="post" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <x-admin.secondary-button type="submit" class="cms-btn-logout">Log out</x-admin.secondary-button>
        </form>
        <a href="{{ url('/') }}" style="display: block; text-align: center; margin-top: 0.75rem; font-size: 0.8rem; color: var(--cms-sidebar-muted);">View site</a>
    </div>
</aside>
<style>
    .cms-btn-logout {
        width: 100%;
        justify-content: center;
        background: rgba(255,255,255,0.08) !important;
        color: #e2e8f0 !important;
        border-color: rgba(148,163,184,0.25) !important;
    }
    .cms-btn-logout:hover {
        background: rgba(255,255,255,0.12) !important;
    }
</style>
