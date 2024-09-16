<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Edit Project</h1>
                    @if (session()->has('error'))
                        <div>
                            {{ session('error') }}
                        </div>
                    @endif
                    <p><a href="{{ route('admin.projects') }}"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            Go Back</a></p>

                    <form action="{{ route('admin.projects.update', $projects->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Project ID -->
                        {{-- <div class="mb-4">
                            <label for="id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID</label>
                            <input type="text" name="id" id="id" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                        </div> --}}

                        <!-- Project Title -->
                        <div class="mb-4 mt-4">
                            <label for="project_title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Title</label>
                            <input type="text" name="project_title" id="project_title"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                value="{{ old('project_title', $projects->project_title) }}"
                                required>
                            @error('project_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Project Description -->
                        <div class="mb-4">
                            <label for="project_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Project Description</label>
                            <textarea name="project_description" id="project_description" 
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                rows="4" required>{{ old('project_description', $projects->project_description) }}</textarea>
                            @error('project_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Project Image -->
                        <div class="mb-4">
                            <label for="project_img" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Image</label>
                            <input type="file" name="project_img" id="project_img" 
                            class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @error('project_img')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Project Year -->
                        <div class="mb-4">
                            <label for="project_year"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Year</label>
                            <input type="number" name="project_year" id="project_year"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                value="{{ old('project_year', $projects->project_year) }}"
                                required>
                            @error('project_year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Student ID -->
                        <div class="mb-4">
                            <label for="student_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student ID</label>
                            <input type="number" name="student_id" id="student_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                value="{{ old('student_id', $projects->student_id) }}"
                                required>
                            @error('student_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Advisor ID -->
                        <div class="mb-4">
                            <label for="advisor_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Advisor ID</label>
                            <input type="number" name="advisor_id" id="advisor_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                value="{{ old('advisor_id', $projects->advisor_id) }}"
                                required>
                            @error('advisor_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
