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
    @vite('./resources/css/tailwind.css')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
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

<script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
@vite('./resources/js/app.js')


@stack('scripts')

</body>
</html>
