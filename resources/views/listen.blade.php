<html lang="en">
    <head>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        <div id="app">

        </div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </body>
</html>
