@extends('layouts.admin')

@section('title', 'Add Media')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-green-700">Add Media</h1>

@if($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
        <label class="block mb-1 font-semibold">Title</label>
        <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block mb-1 font-semibold">Type</label>
        <select name="type" class="w-full border rounded px-3 py-2" required>
            <option value="publication">Publication (PDF)</option>
            <option value="report">Report / Policy Brief (PDF)</option>
            <option value="photo">Photo (Image)</option>
            <option value="video">Video (.mp4)</option>
        </select>
    </div>

    <div>
        <label class="block mb-1 font-semibold">Upload File</label>
        <input type="file" name="file" class="w-full" required>
    </div>

    <div>
        <label class="block mb-1 font-semibold">Order (optional)</label>
        <input type="number" name="order" class="w-full border rounded px-3 py-2">
    </div>

    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Add Media</button>
</form>
@endsection
