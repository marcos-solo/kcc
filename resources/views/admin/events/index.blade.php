@extends('layouts.admin')
@section('title', 'Manage Events')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-bold text-green-700">Manage Events</h1>
  <a href="{{ route('admin.events.create') }}" 
     class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
     + Add Event
  </a>
</div>

@if(session('success'))
  <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
    {{ session('success') }}
  </div>
@endif

<div class="overflow-x-auto bg-white shadow rounded-lg">
  <table class="min-w-full table-auto">
    <thead class="bg-green-600 text-white text-sm uppercase">
      <tr>
        <th class="px-4 py-3 text-left">Title</th>
        <th class="px-4 py-3 text-left">Date</th>
        <th class="px-4 py-3 text-left">Status</th>
        <th class="px-4 py-3 text-left">Image</th>
        <th class="px-4 py-3 text-left">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($events as $event)
      <tr class="border-b hover:bg-green-50">
        <td class="px-4 py-3 font-medium">{{ $event->title }}</td>
        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
        <td class="px-4 py-3">
          <span class="px-2 py-1 text-xs rounded-full {{ $event->is_upcoming ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-700' }}">
            {{ $event->is_upcoming ? 'Upcoming' : 'Past' }}
          </span>
        </td>
        <td class="px-4 py-3">
          @if($event->image)
            <img src="{{ asset('storage/'.$event->image) }}" class="w-12 h-12 rounded object-cover">
          @else
            <span class="text-gray-400 text-sm">No Image</span>
          @endif
        </td>
        <td class="px-4 py-3 space-x-2">
          <a href="{{ route('admin.events.edit', $event->id) }}" 
             class="text-blue-600 hover:underline">Edit</a>
          <form action="{{ route('admin.events.destroy', $event->id) }}" 
                method="POST" 
                class="inline"
                onsubmit="return confirm('Delete this event?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="text-center py-6 text-gray-500">No events found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $events->links() }}
</div>
@endsection
