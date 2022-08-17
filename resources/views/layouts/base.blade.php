<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>
    {{--    <link rel="stylesheet" href="/css/tailwind.css">--}}
    <script src="https://unpkg.com/phosphor-icons"></script>

    @vite('resources/js/app.js')


    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
</head>
<body>

@yield('app')

<script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>


@stack('scripts')

</body>
</html>
