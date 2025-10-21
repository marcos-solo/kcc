@extends('layouts.admin')

@section('title', 'Edit Media')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-green-700">Edit Media Item</h1>

<!-- Success Message -->
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<!-- Validation Errors -->
@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    <strong>Whoops!</strong> There were some problems with your input:
    <ul class="list-disc list-inside mt-2">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Edit Form -->
<div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <form action="{{ route('admin.media.update', $mediaItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $mediaItem->title) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Type -->
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
            <select name="type" id="type"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
                <option value="publication" {{ $mediaItem->type === 'publication' ? 'selected' : '' }}>Publication</option>
                <option value="report" {{ $mediaItem->type === 'report' ? 'selected' : '' }}>Report</option>
                <option value="photo" {{ $mediaItem->type === 'photo' ? 'selected' : '' }}>Photo</option>
                <option value="video" {{ $mediaItem->type === 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <!-- Current File Preview -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Current File</label>
            @php
                $fileUrl = asset('storage/' . $mediaItem->file);
            @endphp

            @if($mediaItem->type === 'photo')
                <img src="{{ $fileUrl }}" alt="{{ $mediaItem->title }}" class="h-32 w-32 object-cover rounded shadow">
            @elseif($mediaItem->type === 'video')
                <video class="h-32 w-48 rounded shadow" controls>
                    <source src="{{ $fileUrl }}" type="video/mp4">
                </video>
            @elseif(in_array($mediaItem->type, ['publication','report']))
                <a href="{{ $fileUrl }}" target="_blank" class="text-blue-600 underline">View Current File</a>
            @endif
        </div>

        <!-- Upload New File -->
        <div class="mb-4">
            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Replace File (optional)</label>
            <input type="file" name="file" id="file"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Order -->
        <div class="mb-4">
            <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
            <input type="number" name="order" id="order" value="{{ old('order', $mediaItem->order) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.media.index') }}" class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded shadow">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow">
                Update Media
            </button>
        </div>
    </form>
</div>
@endsection
