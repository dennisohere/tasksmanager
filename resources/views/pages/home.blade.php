<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
{{--    <link rel="stylesheet" href="/css/tailwind.css">--}}
    @vite('./resources/css/tailwind.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>

<div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    <div class="w-full sm:w-1/2 mx-auto">
        <h1 class="text-3xl text-teal-600 text-center">Tasks Manager</h1>

        <div class="mx-4 mx-auto">
            <x-taskform />
        </div>

        <x-tasks />
    </div>
</div>

</body>
</html>
