@extends('layouts.admin')
@section('title', 'Add Project')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-green-700">Add Project</h1>

<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-semibold mb-1">Title</label>
        <input type="text" name="title" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full border rounded p-2"></textarea>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Project Status</label>
        <select name="status" class="w-full border rounded p-2">
            <option value="ongoing">Ongoing</option>
            <option value="past">Completed / Outgoing</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Project Image</label>
        <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Project PDF</label>
        <input type="file" name="pdf" accept="application/pdf" class="w-full border rounded p-2">
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Save Project
    </button>
</form>
@endsection
