

<div class="px-3.5 mt-3 mb-6 max-h-[400px] overflow-y-auto" id="tasksList"
     x-data="tasksList"
     @filter-project.window="filterProject($event.detail)"
>

    <template x-for="task in tasks">
        <div x-data="{ open: false }"
            class="p-4 bg-white my-2 hover:bg-teal-600 hover:text-white cursor-pointer rounded duration-300 transition ease-in-out flex place-items-center space-x-2 relative">
            <span class="inline-block border-2 border-teal-300 px-2 py-1 rounded">
                #<span x-text="task.priority"></span>
            </span>
            <div class="grow">
                <span x-text="task.name"></span>
                <template x-if="task.project">
                    <div class="text-xs">
                        <span>Project:</span>
                        <span class="font-bold" x-text="task.project.title"></span>
                    </div>
                </template>
            </div>

            <button x-bind:id="'dropdown-toggle-' + task.id"
                    x-bind:data-dropdown-toggle="'dropdown-' + task.id"
                    @click="open = ! open"
                    class="text-white bg-teal-700 hover:bg-teal-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                <i class="ph-dots-three-outline-vertical"></i>
            </button>
            <!-- Dropdown menu -->
            <div x-bind:id="'dropdown-' + task.id"
                 x-show="open"
                 @click.outside="open = false"
                 class="z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 absolute top-14 right-6"
                 data-popper-placement="bottom">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    x-bind:aria-labelledby="'dropdown-toggle-' + task.id">
                    <li>
                        <a :href="'/tasks/' + task.id + '/edit'" class="block py-2 px-4 hover:bg-gray-200 dark:hover:text-white">
                            Edit
                        </a>
                    </li>

                    <li>
                        <form :action="'/tasks/' + task.id" method="post" class="block">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                    class="block w-full text-left py-2 px-4 hover:bg-red-700 hover:text-white">
                                Delete
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </template>

</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('tasksList', () => ({
                tasks: [],

                async filterProject(project){
                    if(project){
                        await this.loadTasks(project.id);
                    } else {
                        await this.loadTasks();
                    }
                },

                async loadTasks(project_id){
                    const tasks = (await window.axios.get('/tasks', {
                        params: {
                            'project_id': project_id
                        }
                    })).data;

                    this.tasks = [];

                    this.$nextTick(() => { this.tasks = tasks; });


                },

                async init(){
                   await this.loadTasks();
                   const vm = this;
                   new window.Sortable(tasksList, {
                        animation: 150,
                        ghostClass: 'bg-lime-400',
                        // Element dragging ended
                        async onEnd (/**Event*/evt) {
                            const task = vm.tasks[evt.oldIndex];

                            const resData = await window.axios.post('/tasks/' + task.id + '/update/priority', {
                                'new_priority': evt.newIndex + 1
                            },);

                            vm.tasks = [];

                            vm.$nextTick(() => { vm.tasks = resData.data; });
                        },
                    });
                }
            }))
        });

    </script>
@endpush
