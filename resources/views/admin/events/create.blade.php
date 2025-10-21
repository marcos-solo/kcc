@extends('layouts.admin')
@section('title', 'Add New Event')

@section('content')
<h1 class="text-2xl font-bold text-green-700 mb-6">Add New Event</h1>

<form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
  @csrf

  <div>
    <label class="block font-semibold mb-1">Event Title</label>
    <input type="text" name="title" value="{{ old('title') }}" 
           class="w-full border rounded p-2" required>
  </div>

  <div>
    <label class="block font-semibold mb-1">Date</label>
    <input type="date" name="date" value="{{ old('date') }}" 
           class="w-full border rounded p-2" required>
  </div>

  <div>
    <label class="block font-semibold mb-1">Description</label>
    <textarea name="description" rows="4" class="w-full border rounded p-2">{{ old('description') }}</textarea>
  </div>

  <div>
    <label class="block font-semibold mb-1">Event Image</label>
    <input type="file" name="image" accept="image/*" class="border p-2 rounded w-full">
  </div>

  <div>
    <label class="block font-semibold mb-1">External Link (Optional)</label>
    <input type="url" name="link" value="{{ old('link') }}" class="w-full border rounded p-2">
  </div>

  <div>
    <label class="block font-semibold mb-1">Event Type</label>
    <select name="is_upcoming" class="w-full border rounded p-2">
      <option value="1" {{ old('is_upcoming') == 1 ? 'selected' : '' }}>Upcoming</option>
      <option value="0" {{ old('is_upcoming') == 0 ? 'selected' : '' }}>Past</option>
    </select>
  </div>

  <div class="pt-4">
    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
      Save Event
    </button>
    <a href="{{ route('admin.events.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
  </div>
</form>
@endsection
