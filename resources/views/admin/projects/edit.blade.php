@extends('layouts.admin')
@section('title', 'Edit Project')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-green-700">Edit Project</h1>

<form action="{{ route('admin.projects.update', $project) }}" 
      method="POST" 
      enctype="multipart/form-data" 
      class="space-y-4 bg-white p-6 rounded-lg shadow-sm border">
    @csrf 
    @method('PUT')

    <div>
        <label class="block text-sm font-semibold mb-1">Title</label>
        <input type="text" 
               name="title" 
               value="{{ old('title', $project->title) }}" 
               class="w-full border rounded p-2" 
               required>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full border rounded p-2">{{ old('description', $project->description) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Project Status</label>
        <select name="status" class="w-full border rounded p-2">
            <option value="ongoing" {{ $project->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
            <option value="past" {{ $project->status == 'past' ? 'selected' : '' }}>Completed / Outgoing</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Project Image</label>
        @if($project->image)
            <div class="mb-2">
                <img src="{{ asset('storage/'.$project->image) }}" class="h-20 rounded shadow">
            </div>
        @endif
        <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
        <small class="text-gray-500 text-sm">Leave blank to keep existing image.</small>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Project PDF</label>
        @if($project->pdf)
            <div class="mb-2">
                <a href="{{ asset('storage/'.$project->pdf) }}" target="_blank" class="text-blue-600 underline">
                    View Current PDF
                </a>
            </div>
        @endif
        <input type="file" name="pdf" accept="application/pdf" class="w-full border rounded p-2">
        <small class="text-gray-500 text-sm">Leave blank to keep existing PDF.</small>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Update Project
        </button>
    </div>
</form>
@endsection
