<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <!-- Include your CSS files -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('login') }}">Login</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <h1>Welcome to the Homepage</h1>
        <p>This is a simple homepage.</p>
    </main>

    <!-- Footer -->
    <footer>
        <nav>
            <a href="{{ route('login') }}">Login</a>
        </nav>
        <p>&copy; {{ date('Y') }} Your Company</p>
    </footer>

    <!-- Include your JS files -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
