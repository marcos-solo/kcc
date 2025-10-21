@extends('layouts.app')
@section('title', 'Video Gallery | KCCWG')

@section('content')
<section class="py-16 max-w-6xl mx-auto text-gray-800 relative overflow-hidden">
  <h1 class="text-3xl font-bold text-green-700 mb-6">Video Gallery</h1>

  @if($videos->count())
  <div class="relative">
    <!-- Navigation Buttons -->
    <button id="scrollLeftVid" 
      class="absolute left-4 top-1/2 -translate-y-1/2 bg-green-600 text-white rounded-full p-5 shadow-lg hover:bg-green-700 hover:scale-110 hover:shadow-2xl transition z-20">
      <i class="fas fa-chevron-left text-2xl"></i>
    </button>

    <button id="scrollRightVid" 
      class="absolute right-4 top-1/2 -translate-y-1/2 bg-green-600 text-white rounded-full p-5 shadow-lg hover:bg-green-700 hover:scale-110 hover:shadow-2xl transition z-20">
      <i class="fas fa-chevron-right text-2xl"></i>
    </button>

    <!-- Carousel Container -->
    <div id="videoCarousel" class="space-y-4 overflow-x-hidden relative group">

      <!-- Row 1 -->
      <div class="flex gap-6 animate-scroll-right will-change-transform group-hover:pause-animation">
        @foreach($videos as $video)
          <div class="flex-none w-96 relative group overflow-hidden rounded-2xl shadow hover:shadow-xl transition">
            <video class="w-full h-64 object-cover" controls>
              <source src="{{ asset('storage/' . $video->file) }}" type="video/mp4">
              Your browser does not support the video tag.
            </video>
            <div class="absolute bottom-0 w-full bg-black bg-opacity-40 py-2 text-center text-white font-semibold opacity-0 group-hover:opacity-100 transition">
              {{ $video->title }}
            </div>
          </div>
        @endforeach
      </div>

      <!-- Row 2 (opposite direction) -->
      <div class="flex gap-6 animate-scroll-left will-change-transform group-hover:pause-animation">
        @foreach($videos->shuffle() as $video)
          <div class="flex-none w-96 relative group overflow-hidden rounded-2xl shadow hover:shadow-xl transition">
            <video class="w-full h-64 object-cover" controls>
              <source src="{{ asset('storage/' . $video->file) }}" type="video/mp4">
              Your browser does not support the video tag.
            </video>
            <div class="absolute bottom-0 w-full bg-black bg-opacity-40 py-2 text-center text-white font-semibold opacity-0 group-hover:opacity-100 transition">
              {{ $video->title }}
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </div>
  @else
    <p class="text-gray-600">No videos available.</p>
  @endif
</section>

<!-- JS for manual scroll control -->
<script>
  const videoCarousel = document.getElementById('videoCarousel');
  const scrollLeftVid = document.getElementById('scrollLeftVid');
  const scrollRightVid = document.getElementById('scrollRightVid');

  scrollLeftVid.addEventListener('click', () => {
    videoCarousel.scrollBy({ left: -400, behavior: 'smooth' });
  });
  scrollRightVid.addEventListener('click', () => {
    videoCarousel.scrollBy({ left: 400, behavior: 'smooth' });
  });
</script>

<style>
  /* Hide scrollbar */
  .no-scrollbar::-webkit-scrollbar { display: none; }
  .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

  /* Auto-scroll animations */
  @keyframes scroll-right {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
  }

  @keyframes scroll-left {
    0% { transform: translateX(0); }
    100% { transform: translateX(50%); }
  }

  .animate-scroll-right {
    animation: scroll-right 50s linear infinite;
  }

  .animate-scroll-left {
    animation: scroll-left 55s linear infinite;
  }

  /* Pause animations on hover */
  .group:hover .animate-scroll-right,
  .group:hover .animate-scroll-left {
    animation-play-state: paused;
  }

  /* Buttons visual polish */
  button {
    transition: all 0.3s ease;
  }

  button:hover {
    box-shadow: 0 0 20px rgba(16, 185, 129, 0.6);
  }
</style>
@endsection
