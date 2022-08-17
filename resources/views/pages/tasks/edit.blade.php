@extends('layouts.base')



@section('app')
    <div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
        <div class="w-full sm:w-1/2 mx-auto">
            <h1 class="text-3xl text-teal-600 text-center">
                {{!isset($task) ? 'Create' : 'Edit'}} Task
            </h1>

            <div class="mx-4 mx-auto">
                <x-taskform :task="isset($task) ? $task : null" />
            </div>

        </div>
    </div>
@endsection
