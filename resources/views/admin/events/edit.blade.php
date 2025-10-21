@extends('layouts.admin')
@section('title', 'Edit Event')

@section('content')
<h1 class="text-2xl font-bold text-green-700 mb-6">Edit Event</h1>

<form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
  @csrf
  @method('PUT')

  <div>
    <label class="block font-semibold mb-1">Event Title</label>
    <input type="text" name="title" value="{{ old('title', $event->title) }}" 
           class="w-full border rounded p-2" required>
  </div>

  <div>
    <label class="block font-semibold mb-1">Date</label>
    <input type="date" name="date" value="{{ old('date', $event->date) }}" 
           class="w-full border rounded p-2" required>
  </div>

  <div>
    <label class="block font-semibold mb-1">Description</label>
    <textarea name="description" rows="4" class="w-full border rounded p-2">{{ old('description', $event->description) }}</textarea>
  </div>

  <div>
    <label class="block font-semibold mb-1">Event Image</label>
    @if($event->image)
      <img src="{{ asset('storage/'.$event->image) }}" class="w-32 h-32 object-cover mb-2 rounded">
    @endif
    <input type="file" name="image" accept="image/*" class="border p-2 rounded w-full">
  </div>

  <div>
    <label class="block font-semibold mb-1">External Link (Optional)</label>
    <input type="url" name="link" value="{{ old('link', $event->link) }}" class="w-full border rounded p-2">
  </div>

  <div>
    <label class="block font-semibold mb-1">Event Type</label>
    <select name="is_upcoming" class="w-full border rounded p-2">
      <option value="1" {{ $event->is_upcoming ? 'selected' : '' }}>Upcoming</option>
      <option value="0" {{ !$event->is_upcoming ? 'selected' : '' }}>Past</option>
    </select>
  </div>

  <div class="pt-4">
    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
      Update Event
    </button>
    <a href="{{ route('admin.events.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
  </div>
</form>
@endsection
