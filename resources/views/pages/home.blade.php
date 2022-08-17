@extends('layouts.base')

@section('app')
    <div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center py-3">
        <div class="w-full sm:w-1/2 mx-auto">

            <div class="flex place-items-center space-x-2 mx-4 mx-auto mb-6 pb-6 border-b border-teal-600">
                <h1 class="text-3xl text-teal-600 grow">Tasks Manager</h1>

                <div class="flex space-x-2">
                    <a href="{{route('tasks.create')}}"
                       class="text-white bg-teal-700 hover:bg-teal-800 font-medium rounded-lg
                        text-lg px-4 py-2.5 text-center inline-flex items-center"
                    >
                        <i class="ph-plus"></i>
                    </a>
                    <button
                        class="text-white bg-teal-700 hover:bg-teal-800 font-medium rounded-lg
                        text-lg px-4 py-2.5 text-center inline-flex items-center"
                    >
                        <i class="ph-funnel"></i>
                    </button>
                </div>
            </div>

            <x-tasks />

        </div>
    </div>
@endsection
