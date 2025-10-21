@extends('layouts.admin')
@section('title', 'Manage News')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-bold text-green-700">Manage News</h1>
  <a href="{{ route('admin.news.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add News</a>
</div>

@if(session('success'))
  <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<table class="w-full border border-gray-200 rounded-lg overflow-hidden text-sm">
  <thead class="bg-green-600 text-white">
    <tr>
      <th class="px-4 py-2 text-left">Title</th>
      <th class="px-4 py-2">Category</th>
      <th class="px-4 py-2">Date</th>
      <th class="px-4 py-2">Status</th>
      <th class="px-4 py-2 text-right">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($news as $item)
      <tr class="border-t hover:bg-gray-50">
        <td class="px-4 py-2 font-semibold text-green-800">{{ $item->title }}</td>
        <td class="px-4 py-2 text-center">{{ $item->category ?? '-' }}</td>
        <td class="px-4 py-2 text-center">{{ $item->published_date ?? 'N/A' }}</td>
        <td class="px-4 py-2 text-center">
          <span class="px-2 py-1 rounded text-xs {{ $item->published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
            {{ $item->published ? 'Published' : 'Draft' }}
          </span>
        </td>
        <td class="px-4 py-2 text-right space-x-2">
          <a href="{{ route('admin.news.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>
          <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete this article?')">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
