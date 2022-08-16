@php
/** @var \App\Models\Task $task */
@endphp

<div class="px-3.5 py-6">
    @forelse($tasks as $task)
        <div class="p-4 bg-white my-2 hover:bg-teal-600 hover:text-white cursor-pointer ">
            {{$task->name}}
        </div>
    @empty

    @endforelse
</div>
