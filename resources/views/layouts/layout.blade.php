<!DOCTYPE html>
<html>
<head>
    <title>Gestion d'Auto-école</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Gestion d'Auto-école</h1>
        <nav>
            <ul>
                <li><a href="{{ route('moniteurs.index') }}">Moniteurs</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; 2024 Gestion d'Auto-école</p>
    </footer>
</body>
</html>
