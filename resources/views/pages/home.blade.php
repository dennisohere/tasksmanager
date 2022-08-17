@extends('layouts.base')

@section('app')
    <div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center py-3"
    x-data="home">
        <div class="w-full sm:w-1/2 mx-auto relative">

            <div class="flex place-items-center space-x-2 mx-4 mx-auto mb-6 pb-6 border-b border-teal-600">
                <h1 class="text-3xl text-teal-600 grow">Tasks Manager</h1>

                <div class="flex space-x-2">
                    <button
                        class="text-teal-700 hover:text-white bg-gray-200 hover:bg-teal-800 font-medium rounded-lg
                        text-lg px-4 py-2.5 text-center inline-flex items-center"
                        @click="showSearchResults = true" @click.away="showSearchResults = false"
                    >
                        <i class="ph-funnel"></i>
                    </button>

                    <a href="{{route('tasks.create')}}"
                       class="text-white bg-teal-500 hover:bg-teal-800 font-medium rounded-lg
                        text-lg px-4 py-2.5 text-center inline-flex items-center"
                    >
                        <i class="ph-plus"></i>
                    </a>
                </div>
            </div>

            <x-tasks />

            <div class="absolute top-12 right-0 bg-white shadow min-w-[300px] max-h-[400px] overflow-y-auto divide-y"
                 x-show="showSearchResults && projects.length">
                <ul>
                    <template x-for="project in projects">
                        <li x-text="project.title" @click="selectProject(project)" class="py-3 px-4 hover:bg-gray-100 cursor-pointer"></li>
                    </template>
                </ul>

                <div x-show="selectedProject" @click="selectProject(null)" class="py-3 px-4 hover:bg-gray-100 cursor-pointer text-red-600">
                    Clear filter
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('home', () => ({
                projects: [],
                showSearchResults: false,
                selectedProject : null,
                async loadProjects(){
                    this.projects = (await window.axios.get('/projects/list')).data;
                },
                selectProject(project){
                    this.selectedProject = project;
                    this.$nextTick(()=>{
                        this.showSearchResults = false;
                    });
                    this.$dispatch('filter-project', this.selectedProject);
                },

                async init(){
                    await this.loadProjects();
                }
            }))
        });

    </script>
@endpush
