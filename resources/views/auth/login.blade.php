<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Site content</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 360px; margin: 4rem auto; padding: 0 1rem; }
        label { display: block; margin-top: 1rem; font-size: 0.875rem; }
        input[type="email"], input[type="password"] { width: 100%; padding: 0.5rem; margin-top: 0.25rem; }
        button { margin-top: 1.25rem; padding: 0.5rem 1rem; cursor: pointer; }
        .error { color: #b91c1c; font-size: 0.875rem; margin-top: 0.25rem; }
    </style>
</head>
<body>
<h1>Admin login</h1>
<form method="post" action="{{ route('login') }}">
    @csrf
    <label for="email">Email</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="password">Password</label>
    <input id="password" type="password" name="password" required autocomplete="current-password">

    <label style="display:flex;align-items:center;gap:0.5rem;margin-top:1rem;">
        <input type="checkbox" name="remember" value="1"> Remember me
    </label>

    <button type="submit">Sign in</button>
</form>
</body>
</html>
