@php
/** @var \App\Models\Task $task */
@endphp

<form class="w-full sm:w-2/3 mx-auto my-12" action="{{route('tasks.store')}}"
      x-data="taskForm({{$task ? $task->toJson() : null}})"
      method="post">
    @csrf
    <template x-if="task.id">
        <input type="hidden" name="id" :value="task.id">
    </template>
    <div class="border-b border-teal-500 py-2 mb-5">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            Task name:
        </label>
        <input class="appearance-none focus:ring-0 bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
               type="text" name="title" aria-label="Title" autocomplete="off" x-model="task.name">
    </div>

    <div class="border-b border-teal-500 py-2 relative">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            Project:
        </label>
        <input class="appearance-none focus:ring-0 bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
               type="text" name="project" aria-label="Title" autocomplete="off" aria-autocomplete="off"
        @focusin="showSearchResults = true" @click.away="showSearchResults = false"
               x-model.debounce.500ms="selectedProjectTitle">

        <div class="absolute bg-white shadow min-w-[300px] max-h-[400px] overflow-y-auto"
             x-show="showSearchResults && projects.length">
            <ul>
                <template x-for="project in projects">
                    <li x-text="project.title" @click="selectProject(project.title)" class="py-3 px-4 hover:bg-gray-100 cursor-pointer"></li>
                </template>
            </ul>
        </div>
    </div>

    <div class="mt-10 flex justify-between items-center">
        <a href="{{route('home')}}"
           class="bg-transparent hover:bg-gray-700 hover:text-white text-sm text-gray-500 py-1 px-2 rounded"
        >
            <i class="ph-arrow-left"></i>
            Back
        </a>
        <button class="bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                type="submit">
            Save
        </button>
    </div>
</form>


@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('taskForm', (editTask) => ({
                projects: [],
                showSearchResults: false,
                selectedProjectTitle : '',
                task: {},
                async loadProjects(search){
                    this.projects = (await window.axios.get('/projects/list', {
                        params: {
                            'search': search
                        }
                    })).data;
                },
                selectProject(title){
                    this.selectedProjectTitle = title;
                    this.$nextTick(()=>{
                        this.showSearchResults = false;
                    });
                },
                async init(){
                    await this.loadProjects();

                    if(editTask){
                        this.task = editTask;
                        if(this.task.project) this.selectedProjectTitle = this.task.project.title;
                    }

                    this.$watch('selectedProjectTitle', (value)=> {
                        this.loadProjects(value);
                    })
                }
            }))
        });

    </script>
@endpush
