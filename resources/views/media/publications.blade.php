@extends('layouts.app')
@section('title', 'Publications | KCCWG')

@section('content')
<section class="py-16 max-w-6xl mx-auto text-gray-800">
  <h1 class="text-3xl font-bold text-green-700 mb-6">Publications</h1>
  <ul class="space-y-4">
    @forelse($publications as $pub)
      <li class="p-4 bg-gray-100 rounded-lg flex justify-between items-center shadow-sm hover:bg-gray-200">
        <span>{{ $pub->title }}</span>
        <a href="{{ asset('storage/' . $pub->file) }}" target="_blank" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">View</a>
      </li>
    @empty
      <p class="text-gray-600">No publications available.</p>
    @endforelse
  </ul>
</section>
@endsection
