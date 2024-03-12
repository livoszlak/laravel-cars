<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Car app')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <div class="logo" onclick="openNav()">
            <img src="{{url('assets/Logo-placeholder.svg')}}" alt="Car app logo">
        </div>
        @yield('sidenav')

    </header>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/sidenav.js') }}"></script>

    <footer>
    </footer>
</body>

</html>