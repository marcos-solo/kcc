@extends('layouts.admin')
@section('title', 'Manage Projects')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-green-700">Projects</h1>
    <a href="{{ route('admin.projects.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Add Project
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
    <thead>
        <tr class="bg-green-600 text-white text-left">
            <th class="py-2 px-4">Title</th>
            <th class="py-2 px-4">Image</th>
            <th class="py-2 px-4">PDF</th>
            <th class="py-2 px-4">Status</th>
            <th class="py-2 px-4">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($projects as $project)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-2 px-4 font-medium">{{ $project->title }}</td>
                
                <td class="py-2 px-4">
                    @if($project->image)
                        <img src="{{ asset('storage/'.$project->image) }}" class="h-10 rounded shadow">
                    @else
                        <span class="text-gray-500 italic">No image</span>
                    @endif
                </td>

                <td class="py-2 px-4">
                    @if($project->pdf)
                        <a href="{{ asset('storage/'.$project->pdf) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">
                            View PDF
                        </a>
                    @else
                        <span class="text-gray-500 italic">No PDF</span>
                    @endif
                </td>

                <td class="py-2 px-4 capitalize">
                    @if($project->status === 'ongoing')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm font-semibold">Ongoing</span>
                    @else
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm font-semibold">Completed</span>
                    @endif
                </td>

                <td class="py-2 px-4 space-x-2">
                    <a href="{{ route('admin.projects.edit', $project) }}" 
                       class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">
                        Edit
                    </a>
                    <form action="{{ route('admin.projects.destroy', $project) }}" 
                          method="POST" 
                          class="inline-block" 
                          onsubmit="return confirm('Are you sure you want to delete this project?')">
                        @csrf 
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-gray-500 py-4">No projects found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $projects->links() }}
</div>
@endsection
