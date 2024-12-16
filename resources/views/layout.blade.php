<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Default Title')</title>
</head>
<body>
    <header>
        <h1>My Laravel App</h1>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
