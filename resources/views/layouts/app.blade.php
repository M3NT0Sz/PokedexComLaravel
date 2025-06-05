<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémons - {{ ucfirst($details['name']) }}</title>
    <link rel="icon" type="image/png" href="{{ $details['sprites']['other']['home']['front_default'] }}">
</head>

<body>
    @yield('content')
    @vite('resources/js/app.js')
</body>

</html>