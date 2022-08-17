

<form class="w-full my-12" action="{{route('tasks.store')}}" method="post">
    @csrf
    <div class="flex items-center border-b border-teal-500 py-2">
        <input class="appearance-none focus:ring-0 bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
               type="text" placeholder="Task's Title" name="title" aria-label="Title">
        <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                type="submit">
            Create
        </button>
    </div>
</form>
