<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Under Construction — {{ config('app.name') }}</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body {
            background-color: #120f0d;
            color: #fff;
        }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Ubuntu, sans-serif;
        }
        .under-construction {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.75rem;
            padding: 2rem;
            text-align: center;
        }
        .under-construction__logo {
            display: block;
            max-width: min(200px, 80vw);
            height: auto;
        }
        .under-construction__title {
            margin: 0;
            font-size: clamp(0.875rem, 2.5vw, 1rem);
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #fff;
        }
    </style>
</head>
<body>
    @include('partials.framer._body_under_construction')
</body>
</html>
