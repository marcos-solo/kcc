@extends('layouts.app')

@section('title', 'Media Gallery')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-4xl font-bold text-green-700 mb-8 text-center">Media Gallery</h1>

    <!-- Photos Section -->
    @if($photos->count())
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Photos</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
        @foreach($photos as $photo)
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <img src="{{ asset('storage/' . $photo->file) }}" alt="{{ $photo->title }}" class="h-48 w-full object-cover">
            <div class="p-3 text-center">
                <h3 class="text-sm font-medium text-gray-800">{{ $photo->title }}</h3>
                <a href="{{ route('media.show', $photo->slug) }}" class="text-green-600 text-sm mt-1 inline-block">View</a>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Videos Section -->
    @if($videos->count())
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Videos</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        @foreach($videos as $video)
        <div class="bg-white shadow rounded-lg p-3">
            <video class="w-full rounded-lg" controls>
                <source src="{{ asset('storage/' . $video->file) }}" type="video/mp4">
            </video>
            <p class="mt-2 text-center font-medium text-gray-700">{{ $video->title }}</p>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Publications Section -->
    @if($publications->count())
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Publications</h2>
    <ul class="space-y-3 mb-10">
        @foreach($publications as $publication)
        <li>
            <a href="{{ asset('storage/' . $publication->file) }}" target="_blank"
               class="text-green-700 hover:underline font-medium">
                📘 {{ $publication->title }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif

    <!-- Reports Section -->
    @if($reports->count())
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Reports</h2>
    <ul class="space-y-3">
        @foreach($reports as $report)
        <li>
            <a href="{{ asset('storage/' . $report->file) }}" target="_blank"
               class="text-green-700 hover:underline font-medium">
                📄 {{ $report->title }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection
