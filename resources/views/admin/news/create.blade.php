@extends('layouts.admin')
@section('title', 'Add News')

@section('content')
<h1 class="text-2xl font-bold text-green-700 mb-6">Add New Article</h1>

<form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="space-y-4">
  @csrf

  <div>
    <label class="font-semibold">Title</label>
    <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
  </div>

  <div>
    <label class="font-semibold">Category</label>
    <input type="text" name="category" class="w-full border rounded px-3 py-2" placeholder="Policy, Story, Event...">
  </div>

  <div>
    <label class="font-semibold">Excerpt</label>
    <textarea name="excerpt" rows="3" class="w-full border rounded px-3 py-2"></textarea>
  </div>

  <div>
    <label class="font-semibold">Content</label>
    <textarea name="content" rows="6" class="w-full border rounded px-3 py-2"></textarea>
  </div>

  <div>
    <label class="font-semibold">Image</label>
    <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
  </div>

  <div class="flex gap-4 items-center">
    <label class="font-semibold">Published</label>
    <input type="checkbox" name="published" value="1" checked>
  </div>

  <div>
    <label class="font-semibold">Published Date</label>
    <input type="date" name="published_date" class="w-full border rounded px-3 py-2">
  </div>

  <button class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Save Article</button>
</form>
@endsection
