@extends('layouts.admin')

@section('title', 'Manage Media')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-green-700">Manage Media</h1>

<!-- Success Message -->
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<!-- Add New Media Button -->
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.media.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow">
        + Add New Media
    </a>
</div>

<!-- Media Items Table -->
<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-green-100">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Title</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Type</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Preview / File</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Order</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @forelse($mediaItems as $item)
            @php
                $fileUrl = asset('storage/' . $item->file);
            @endphp

            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    {{ $loop->iteration + ($mediaItems->currentPage() - 1) * $mediaItems->perPage() }}
                </td>
                <td class="px-6 py-4">{{ $item->title }}</td>
                <td class="px-6 py-4 capitalize">{{ $item->type }}</td>
                <td class="px-6 py-4 flex items-center gap-2">
                    @if($item->type === 'photo')
                        <img src="{{ $fileUrl }}" alt="{{ $item->title }}" class="h-16 w-16 object-cover rounded">
                        <a href="{{ $fileUrl }}" target="_blank" class="text-blue-600 underline">View</a>
                    @elseif($item->type === 'video')
                        <video class="h-20 w-32 rounded" controls>
                            <source src="{{ $fileUrl }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <a href="{{ $fileUrl }}" target="_blank" class="text-blue-600 underline">View</a>
                    @elseif(in_array($item->type, ['publication', 'report']))
                        <a href="{{ $fileUrl }}" target="_blank" class="text-blue-600 underline">View File</a>
                    @endif
                </td>
                <td class="px-6 py-4">{{ $item->order }}</td>
                <td class="px-6 py-4 flex gap-2">
                    <a href="{{ route('admin.media.edit', $item->id) }}" 
                       class="px-2 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded text-sm">
                       Edit
                    </a>
                    <form action="{{ route('admin.media.destroy', $item->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this media item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No media items found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $mediaItems->links() }}
</div>
@endsection
