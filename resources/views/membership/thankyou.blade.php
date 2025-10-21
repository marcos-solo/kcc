@extends('layouts.app')

@section('title', 'Thank You')

@section('content')
<div class="max-w-2xl mx-auto py-20 text-center">
  <div class="bg-white rounded-2xl shadow p-10 border border-green-100">
    <div class="bg-green-100 w-20 h-20 mx-auto flex items-center justify-center rounded-full mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
      </svg>
    </div>
    <h2 class="text-2xl font-bold text-green-700 mb-3">Thank You for Joining!</h2>
    <p class="text-gray-600 mb-6">
      Your membership registration was successful. Welcome to the Kenya Climate Change Working Group!
    </p>
    <a href="{{ route('home') }}" class="px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition">
      Go Back Home
    </a>
  </div>
</div>
@endsection
