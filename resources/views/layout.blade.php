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
        <div class="logo">
            <a href="/dashboard"><img src="{{url('assets/Logo-placeholder.svg')}}" alt="Car app logo"></a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
    </footer>
</body>

</html>