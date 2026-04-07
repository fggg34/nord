@props(['title' => '', 'description' => null])

<section {{ $attributes->merge(['style' => 'background: var(--cms-surface); border-radius: var(--cms-radius); box-shadow: var(--cms-shadow); border: 1px solid var(--cms-border); padding: 1.35rem 1.5rem 1.5rem; margin-bottom: 1.5rem;']) }}>
    <header style="margin-bottom: 1.15rem; padding-bottom: 0.85rem; border-bottom: 1px solid var(--cms-border);">
        <h2 style="margin: 0; font-family: 'Fraunces', Georgia, serif; font-size: 1.1rem; font-weight: 600; color: var(--cms-text);">{{ $title }}</h2>
        @if ($description)
            <p style="margin: 0.35rem 0 0; font-size: 0.85rem; color: var(--cms-muted); max-width: 52rem;">{{ $description }}</p>
        @endif
    </header>
    {{ $slot }}
</section>
