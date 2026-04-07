#!/usr/bin/env python3
"""
Import Framer static HTML export into Laravel Blade partials.
Run: python3 tools/import_framer_export.py
"""
from __future__ import annotations

import re
from pathlib import Path

EXPORT = Path("/Users/kevinhitaj/Downloads/website-export (3)")
PROJECT = Path(__file__).resolve().parent.parent
VIEWS = PROJECT / "resources" / "views"
PARTIALS = VIEWS / "partials" / "framer"

FRAMER_ORIGIN = "https://loginord.framer.website"

PAGES: list[tuple[str, str, str]] = [
    ("index.html", "/", "home"),
    ("about-us/index.html", "/about-us", "about-us"),
    ("contact-us/index.html", "/contact-us", "contact-us"),
    ("services/index.html", "/services", "services"),
    ("our-fleet/index.html", "/our-fleet", "our-fleet"),
    ("industries/index.html", "/industries", "industries"),
    ("privacy-policy/index.html", "/privacy-policy", "privacy-policy"),
    ("404/index.html", "/404", "error-404"),
    ("search.html", "/search", "search"),
]

NCE_BLOCK = re.compile(
    r'var origin = "https://loginord\.framer\.website";\s*'
    r'var allowed = \[[^\]]+\];\s*'
    r'var currentPath = "[^"]*";\s*'
    r'var relativeRoot = "[^"]*";\s*'
    r'function normalizePath\(pathname\) \{\s*'
    r'var withoutIndex = pathname\.replace\(/\\/index\\.html\$/i, ""\);\s*'
    r'var withoutTrailingSlash = withoutIndex\.replace\(/\\/\$/, ""\);\s*'
    r'return withoutTrailingSlash \|\| "/";\s*'
    r'\}\s*'
    r'function buildExportHref\(url\) \{\s*'
    r'var clean = normalizePath\(url\.pathname\);\s*'
    r'if \(clean === currentPath && url\.hash\) \{\s*'
    r'return url\.hash;\s*'
    r'\}\s*'
    r'var targetPath = clean === "/" \? "index.html" : clean\.substring\(1\) \+ "/index.html";\s*'
    r'return relativeRoot \+ targetPath \+ \(url\.hash \|\| ""\);\s*'
    r'\}',
    re.DOTALL,
)

NCE_REPLACEMENT = """var origin = window.location.origin;
    var allowed = [origin + "/", origin + "/404", origin + "/about-us", origin + "/contact-us", origin + "/industries", origin + "/our-fleet", origin + "/privacy-policy", origin + "/services"];
    var currentPath = "{current_path}";
    var relativeRoot = "/";

    function normalizePath(pathname) {{
        var withoutIndex = pathname.replace(/\\/index\\.html$/i, "");
        var withoutTrailingSlash = withoutIndex.replace(/\\/$/, "");
        return withoutTrailingSlash || "/";
    }}

    function buildExportHref(url) {{
        var clean = normalizePath(url.pathname);
        if (clean === currentPath && url.hash) {{
            return url.hash;
        }}
        return clean + (url.hash || "");
    }}"""


def fix_search_index_meta(s: str) -> str:
    return (
        s.replace('content="../search-index.json"', 'content="{{ asset(\'search-index.json\') }}"')
        .replace('content="./search-index.json"', 'content="{{ asset(\'search-index.json\') }}"')
    )


def framer_urls_to_blade(s: str) -> str:
    def repl(m: re.Match) -> str:
        path = m.group(1) or "/"
        if path != "/" and not path.startswith("/"):
            path = "/" + path.lstrip("/")
        inner = path.replace("'", "\\'")
        return "{{ url('" + inner + "') }}"

    return re.sub(re.escape(FRAMER_ORIGIN) + r"(/[^\"'\\s>]*)?", repl, s)


def patch_nocode_router(body: str, current_path: str) -> str:
    m = NCE_BLOCK.search(body)
    if not m:
        return body
    return body[: m.start()] + NCE_REPLACEMENT.format(current_path=current_path) + body[m.end() :]


def patch_search_hrefs(body: str) -> str:
    old = (
        "var href = p.path === '/' ? 'index.html' : p.path.replace(/^\\//, '') + '/index.html';"
    )
    new = "var href = p.path === '/' ? '/' : p.path;"
    return body.replace(old, new)


def fix_internal_route_hrefs(html: str) -> str:
    """
    Replace static export hrefs (./ and ../ + index.html) with Laravel url().
    Absolute paths ignore <base> and stay correct after Framer hydrates the DOM
    (fixes header nav appearing to only reload the current page).
    """
    href_pairs: list[tuple[str, str]] = [
        ('href="../contact-us/index.html#contacts"', 'href="{{ url(\'/contact-us\') }}#contacts"'),
        ('href="./contact-us/index.html#contacts"', 'href="{{ url(\'/contact-us\') }}#contacts"'),
        ('href="../privacy-policy/index.html"', 'href="{{ url(\'/privacy-policy\') }}"'),
        ('href="./privacy-policy/index.html"', 'href="{{ url(\'/privacy-policy\') }}"'),
        ('href="../industries/index.html"', 'href="{{ url(\'/industries\') }}"'),
        ('href="./industries/index.html"', 'href="{{ url(\'/industries\') }}"'),
        ('href="../our-fleet/index.html"', 'href="{{ url(\'/our-fleet\') }}"'),
        ('href="./our-fleet/index.html"', 'href="{{ url(\'/our-fleet\') }}"'),
        ('href="../services/index.html"', 'href="{{ url(\'/services\') }}"'),
        ('href="./services/index.html"', 'href="{{ url(\'/services\') }}"'),
        ('href="../about-us/index.html"', 'href="{{ url(\'/about-us\') }}"'),
        ('href="./about-us/index.html"', 'href="{{ url(\'/about-us\') }}"'),
        ('href="../contact-us/index.html"', 'href="{{ url(\'/contact-us\') }}"'),
        ('href="./contact-us/index.html"', 'href="{{ url(\'/contact-us\') }}"'),
        ('href="../index.html"', 'href="{{ url(\'/\') }}"'),
        ('href="./index.html"', 'href="{{ url(\'/\') }}"'),
    ]
    for old, new in href_pairs:
        html = html.replace(old, new)
    return html


def extract_parts(html: str) -> tuple[str, str]:
    hm = re.search(r"(?is)<head>(.*)</head>", html)
    bm = re.search(r"(?is)<body>(.*)</body>", html)
    if not hm or not bm:
        raise ValueError("Missing head or body")
    return hm.group(1), bm.group(1)


def extract_html_attrs(raw: str) -> str:
    m = re.search(r"(?is)<html([^>]*)>", raw)
    inner = (m.group(1) or "").strip()
    return inner if inner else 'lang="en" class="lenis"'


def blade_escape_attr(s: str) -> str:
    """For use inside @extends second arg single-quoted PHP strings."""
    return s.replace("\\", "\\\\").replace("'", "\\'")


def main() -> None:
    PARTIALS.mkdir(parents=True, exist_ok=True)

    for rel, current_path, name in PAGES:
        src = EXPORT / rel
        if not src.exists():
            print("SKIP missing:", src)
            continue
        raw = src.read_text(encoding="utf-8")
        html_attrs = extract_html_attrs(raw)
        head_inner, body_inner = extract_parts(raw)
        # Patch NoCode Export router before replacing framer domain strings globally
        # (otherwise var origin = "https://..." becomes Blade and the router regex no longer matches).
        body_inner = patch_nocode_router(body_inner, current_path)
        head_inner = framer_urls_to_blade(head_inner)
        head_inner = fix_search_index_meta(head_inner)
        body_inner = framer_urls_to_blade(body_inner)
        body_inner = fix_internal_route_hrefs(body_inner)
        if name == "search":
            body_inner = patch_search_hrefs(body_inner)

        (PARTIALS / f"_head_{name}.blade.php").write_text(head_inner + "\n", encoding="utf-8")
        (PARTIALS / f"_body_{name}.blade.php").write_text(body_inner + "\n", encoding="utf-8")

        attrs_q = blade_escape_attr(html_attrs)
        (VIEWS / f"{name}.blade.php").write_text(
            f"@extends('layouts.app', ['htmlAttrs' => ' {attrs_q}'])\n\n"
            f"@section('head_inner')\n"
            f"    @include('partials.framer._head_{name}')\n"
            f"@endsection\n\n"
            f"@section('body_inner')\n"
            f"    @include('partials.framer._body_{name}')\n"
            f"@endsection\n",
            encoding="utf-8",
        )
        print("OK", name)

    (VIEWS / "layouts" / "app.blade.php").write_text(
        """<!DOCTYPE html>
<html{!! $htmlAttrs ?? ' lang="en" class="lenis"' !!}>
<head>
    <base href="{{ url('/') }}">
    @yield('head_inner')
</head>
<body>
    @yield('body_inner')
</body>
</html>
""",
        encoding="utf-8",
    )
    print("Wrote layout")

    (PROJECT / "routes" / "web.php").write_text(
        """<?php

use Illuminate\\Support\\Facades\\Route;

Route::view('/', 'home');
Route::view('/about-us', 'about-us');
Route::view('/contact-us', 'contact-us');
Route::view('/services', 'services');
Route::view('/our-fleet', 'our-fleet');
Route::view('/industries', 'industries');
Route::view('/privacy-policy', 'privacy-policy');
Route::view('/404', 'error-404');
Route::view('/search', 'search');

Route::fallback(function () {
    return response()->view('error-404', [], 404);
});
""",
        encoding="utf-8",
    )
    print("Wrote routes")


if __name__ == "__main__":
    main()
