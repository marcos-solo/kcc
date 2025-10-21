@extends('layouts.app')
@section('title', 'Events | KCCWG')
@section('content')

<section class="py-16 bg-gradient-to-b from-green-50 via-white to-green-100">
  <div class="max-w-6xl mx-auto px-6">
    <h1 class="text-4xl font-bold text-green-700 text-center mb-10">Upcoming & Past Events</h1>

    <!-- 🗓️ Upcoming Events -->
    <h2 class="text-2xl font-semibold mb-4">Upcoming Events</h2>
    @php
      $upcoming = \App\Models\Event::where('is_upcoming', true)->orderBy('date')->get();
    @endphp

    @if($upcoming->count())
    <div x-data="{ scrollLeft() { $refs.upcoming.scrollBy({ left: -300, behavior: 'smooth' }) }, scrollRight() { $refs.upcoming.scrollBy({ left: 300, behavior: 'smooth' }) } }" class="relative mb-16">
      <button @click="scrollLeft()" class="absolute -left-5 top-1/2 transform -translate-y-1/2 bg-green-600 text-white p-3 rounded-full hidden md:block hover:bg-green-700">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
      </button>

      <div x-ref="upcoming" class="flex gap-8 overflow-x-auto scroll-smooth scrollbar-hide py-4">
        @foreach($upcoming as $event)
          <div class="bg-white rounded-xl shadow-md p-5 w-72 flex-shrink-0">
            <img src="{{ $event->image ? asset('storage/'.$event->image) : 'https://via.placeholder.com/600x400?text=No+Image' }}" class="rounded-lg mb-4 w-full h-40 object-cover">
            <h3 class="text-green-700 font-semibold">{{ $event->title }}</h3>
            <p class="text-sm text-gray-600 mb-2">Date: {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
            <p class="text-gray-700 text-sm mb-4">{{ Str::limit($event->description, 120) }}</p>
            @if($event->link)
              <a href="{{ $event->link }}" target="_blank" class="text-green-600 font-medium hover:underline">Learn More →</a>
            @endif
          </div>
        @endforeach
      </div>

      <button @click="scrollRight()" class="absolute -right-5 top-1/2 transform -translate-y-1/2 bg-green-600 text-white p-3 rounded-full hidden md:block hover:bg-green-700">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
      </button>
    </div>
    @else
      <p class="text-gray-500 italic mb-10">No upcoming events available.</p>
    @endif

    <!-- 📸 Past Events -->
    <h2 class="text-2xl font-semibold mb-4">Past Events</h2>
    @php
      $past = \App\Models\Event::where('is_upcoming', false)->orderByDesc('date')->get();
    @endphp

    @if($past->count())
      <div class="grid md:grid-cols-3 gap-6">
        @foreach($past as $event)
          <div class="bg-white rounded-xl shadow-md p-4">
            <img src="{{ $event->image ? asset('storage/'.$event->image) : 'https://via.placeholder.com/600x400?text=No+Image' }}" class="rounded-lg mb-3 w-full h-48 object-cover">
            <h4 class="text-green-700 font-semibold mb-1">{{ $event->title }}</h4>
            <p class="text-sm text-gray-600 mb-2">Date: {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
            <p class="text-gray-600 text-sm">{{ Str::limit($event->description, 100) }}</p>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-gray-500 italic">No past events found.</p>
    @endif
  </div>
</section>

<style>
  .scrollbar-hide::-webkit-scrollbar { display: none; }
  .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

@endsection
