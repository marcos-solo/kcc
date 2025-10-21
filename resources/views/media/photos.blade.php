@extends('layouts.app')
@section('title', 'Photo Gallery | KCCWG')

@section('content')
<section class="py-16 max-w-7xl mx-auto text-gray-800 relative overflow-hidden">
  <!-- Enhanced Header -->
  <div class="text-center mb-12">
    <div class="inline-flex items-center justify-center mb-4">
      <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-3">
        <i class="fas fa-camera text-white text-xl"></i>
      </div>
      <h1 class="text-5xl font-bold bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">Photo Gallery</h1>
    </div>
    <p class="text-gray-600 text-lg max-w-2xl mx-auto">Explore our collection of memorable moments captured through the lens of KCCWG community</p>
    <div class="w-24 h-1 bg-gradient-to-r from-green-400 to-emerald-400 mx-auto mt-4 rounded-full"></div>
  </div>

  @if($photos->count())
  <div class="relative">
    <!-- Enhanced Navigation Buttons -->
    <button id="scrollLeft" 
      class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 backdrop-blur-sm text-green-700 rounded-full p-4 shadow-2xl hover:bg-white hover:scale-110 hover:shadow-2xl transition-all duration-300 z-20 border border-green-100 group">
      <i class="fas fa-chevron-left text-xl group-hover:scale-110 transition-transform"></i>
    </button>

    <button id="scrollRight" 
      class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 backdrop-blur-sm text-green-700 rounded-full p-4 shadow-2xl hover:bg-white hover:scale-110 hover:shadow-2xl transition-all duration-300 z-20 border border-green-100 group">
      <i class="fas fa-chevron-right text-xl group-hover:scale-110 transition-transform"></i>
    </button>

    <!-- Carousel Container -->
    <div id="photoCarousel" class="space-y-8 overflow-x-hidden relative group no-scrollbar py-4">

      <!-- Row 1 -->
      <div class="flex gap-8 animate-scroll-right will-change-transform group-hover:pause-animation">
        @foreach($photos as $photo)
          <div class="flex-none w-80 relative group overflow-hidden rounded-3xl shadow-2xl hover:shadow-2xl transition-all duration-500 cursor-pointer photo-item" data-id="{{ $photo->id }}">
            <!-- KCCWG Brand Badge -->
            <div class="absolute top-4 left-4 z-20">
              <div class="bg-gradient-to-r from-green-600 to-emerald-500 text-white px-3 py-1.5 rounded-full flex items-center shadow-lg border border-white/20">
                <i class="fas fa-camera-retro text-xs mr-1.5"></i>
                <span class="text-xs font-bold tracking-wide">KCCWG PHOTO</span>
              </div>
            </div>
            
            <div class="relative overflow-hidden rounded-3xl">
              <img src="{{ asset('storage/' . $photo->file) }}" 
                   alt="{{ $photo->title }}" 
                   class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-700">
              
              <!-- Enhanced Overlay -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 flex items-end transition-all duration-500 p-6">
                <div class="text-center w-full transform translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                  <div class="flex items-center justify-center mb-3">
                    <i class="fas fa-calendar-alt text-green-300 mr-2 text-sm"></i>
                    <span class="text-green-300 text-sm">{{ $photo->created_at->format('M d, Y') }}</span>
                  </div>
                  <h3 class="text-white font-bold text-xl mb-2">{{ $photo->title }}</h3>
                  @if($photo->description)
                  <p class="text-gray-200 text-sm leading-relaxed">{{ Str::limit($photo->description, 80) }}</p>
                  @endif
                  <div class="flex justify-center space-x-3 mt-4">
                    <div class="bg-green-500/20 text-green-300 px-3 py-1 rounded-full text-xs flex items-center">
                      <i class="fas fa-eye mr-1"></i>
                      <span>View</span>
                    </div>
                    <div class="bg-white/20 text-white px-3 py-1 rounded-full text-xs flex items-center">
                      <i class="fas fa-share-alt mr-1"></i>
                      <span>Share</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Expand Button -->
            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-green-700 rounded-full w-10 h-10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-0 group-hover:scale-100 shadow-lg hover:bg-white hover:scale-110">
              <i class="fas fa-expand-arrows-alt text-sm"></i>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Row 2 (moves opposite direction) -->
      <div class="flex gap-8 animate-scroll-left will-change-transform group-hover:pause-animation">
        @foreach($photos->shuffle() as $photo)
          <div class="flex-none w-80 relative group overflow-hidden rounded-3xl shadow-2xl hover:shadow-2xl transition-all duration-500 cursor-pointer photo-item" data-id="{{ $photo->id }}">
            <!-- KCCWG Brand Badge -->
            <div class="absolute top-4 left-4 z-20">
              <div class="bg-gradient-to-r from-green-600 to-emerald-500 text-white px-3 py-1.5 rounded-full flex items-center shadow-lg border border-white/20">
                <i class="fas fa-camera-retro text-xs mr-1.5"></i>
                <span class="text-xs font-bold tracking-wide">KCCWG PHOTO</span>
              </div>
            </div>
            
            <div class="relative overflow-hidden rounded-3xl">
              <img src="{{ asset('storage/' . $photo->file) }}" 
                   alt="{{ $photo->title }}" 
                   class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-700">
              
              <!-- Enhanced Overlay -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 flex items-end transition-all duration-500 p-6">
                <div class="text-center w-full transform translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                  <div class="flex items-center justify-center mb-3">
                    <i class="fas fa-calendar-alt text-green-300 mr-2 text-sm"></i>
                    <span class="text-green-300 text-sm">{{ $photo->created_at->format('M d, Y') }}</span>
                  </div>
                  <h3 class="text-white font-bold text-xl mb-2">{{ $photo->title }}</h3>
                  @if($photo->description)
                  <p class="text-gray-200 text-sm leading-relaxed">{{ Str::limit($photo->description, 80) }}</p>
                  @endif
                  <div class="flex justify-center space-x-3 mt-4">
                    <div class="bg-green-500/20 text-green-300 px-3 py-1 rounded-full text-xs flex items-center">
                      <i class="fas fa-eye mr-1"></i>
                      <span>View</span>
                    </div>
                    <div class="bg-white/20 text-white px-3 py-1 rounded-full text-xs flex items-center">
                      <i class="fas fa-share-alt mr-1"></i>
                      <span>Share</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Expand Button -->
            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-green-700 rounded-full w-10 h-10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-0 group-hover:scale-100 shadow-lg hover:bg-white hover:scale-110">
              <i class="fas fa-expand-arrows-alt text-sm"></i>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    
    <!-- Enhanced Gallery Controls -->
    <div class="flex flex-col sm:flex-row justify-center items-center mt-12 space-y-4 sm:space-y-0 sm:space-x-6">
      <div class="flex items-center space-x-4 bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-green-100">
        <button id="pauseAnimation" class="bg-green-600 text-white px-5 py-2.5 rounded-xl hover:bg-green-700 transition-all duration-300 flex items-center shadow hover:shadow-lg group">
          <i class="fas fa-pause mr-2 group-hover:scale-110 transition-transform"></i> 
          <span>Pause Scroll</span>
        </button>
        <button id="playAnimation" class="bg-emerald-500 text-white px-5 py-2.5 rounded-xl hover:bg-emerald-600 transition-all duration-300 flex items-center shadow hover:shadow-lg group">
          <i class="fas fa-play mr-2 group-hover:scale-110 transition-transform"></i> 
          <span>Play Scroll</span>
        </button>
      </div>
      
      <div class="flex items-center space-x-4 bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-green-100">
        <div class="flex items-center space-x-3">
          <i class="fas fa-tachometer-alt text-green-600"></i>
          <span class="text-gray-700 font-medium">Scroll Speed:</span>
          <select id="animationSpeed" class="border border-green-200 rounded-xl p-2.5 bg-white focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
            <option value="slow">Slow</option>
            <option value="normal" selected>Normal</option>
            <option value="fast">Fast</option>
          </select>
        </div>
      </div>
    </div>
    
    <!-- Photo Counter -->
    <div class="text-center mt-8">
      <div class="inline-flex items-center bg-green-50 rounded-full px-6 py-3 border border-green-200">
        <i class="fas fa-images text-green-600 mr-2"></i>
        <span class="text-green-700 font-medium">{{ $photos->count() }} Photos in Gallery</span>
      </div>
    </div>
  </div>
  @else
    <!-- Enhanced Empty State -->
    <div class="text-center py-16 bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl border border-green-200">
      <div class="w-24 h-24 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
        <i class="fas fa-camera text-white text-3xl"></i>
      </div>
      <h3 class="text-2xl font-bold text-gray-700 mb-3">Gallery is Empty</h3>
      <p class="text-gray-600 max-w-md mx-auto mb-6">No photos have been added to the gallery yet. Check back soon for updates!</p>
      <div class="flex justify-center space-x-4">
        <button class="bg-green-600 text-white px-6 py-2.5 rounded-xl hover:bg-green-700 transition flex items-center shadow">
          <i class="fas fa-sync-alt mr-2"></i>
          <span>Refresh</span>
        </button>
        <button class="bg-white text-green-600 border border-green-600 px-6 py-2.5 rounded-xl hover:bg-green-50 transition flex items-center shadow">
          <i class="fas fa-envelope mr-2"></i>
          <span>Get Notified</span>
        </button>
      </div>
    </div>
  @endif
</section>

<!-- Enhanced Lightbox Modal -->
<div id="lightboxModal" class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 flex items-center justify-center hidden">
  <div class="max-w-6xl max-h-full relative mx-4">
    <!-- Close Button -->
    <button id="closeLightbox" class="absolute -top-16 right-0 text-white text-2xl z-10 hover:text-green-400 transition-all duration-300 bg-black/50 rounded-full w-12 h-12 flex items-center justify-center backdrop-blur-sm hover:bg-black/70">
      <i class="fas fa-times"></i>
    </button>
    
    <!-- Navigation Buttons -->
    <button id="prevPhoto" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-2xl z-10 hover:text-green-400 transition-all duration-300 bg-black/50 rounded-full w-12 h-12 flex items-center justify-center backdrop-blur-sm hover:bg-black/70 hover:scale-110">
      <i class="fas fa-chevron-left"></i>
    </button>
    
    <button id="nextPhoto" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-2xl z-10 hover:text-green-400 transition-all duration-300 bg-black/50 rounded-full w-12 h-12 flex items-center justify-center backdrop-blur-sm hover:bg-black/70 hover:scale-110">
      <i class="fas fa-chevron-right"></i>
    </button>
    
    <!-- Lightbox Content -->
    <div class="bg-white rounded-3xl overflow-hidden shadow-2xl">
      <div class="p-1 bg-gradient-to-r from-green-500 to-emerald-400">
        <div class="bg-white rounded-2xl p-6">
          <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-2/3">
              <img id="lightboxImage" src="" alt="" class="w-full max-h-[70vh] object-contain rounded-xl shadow-lg">
            </div>
            <div class="lg:w-1/3 lg:pl-8 mt-6 lg:mt-0">
              <div class="flex items-center mb-4">
                <div class="bg-gradient-to-r from-green-600 to-emerald-500 text-white px-4 py-2 rounded-full flex items-center shadow">
                  <i class="fas fa-camera-retro text-sm mr-2"></i>
                  <span class="text-sm font-bold">KCCWG PHOTO</span>
                </div>
              </div>
              <h3 id="lightboxTitle" class="text-2xl font-bold text-gray-800 mb-3"></h3>
              <p id="lightboxDescription" class="text-gray-600 mb-6 leading-relaxed"></p>
              
              <div class="space-y-4">
                <div class="flex items-center text-gray-500">
                  <i class="fas fa-calendar-alt mr-3 text-green-500"></i>
                  <span id="lightboxDate"></span>
                </div>
                <div class="flex space-x-3">
                  <!-- <button class="flex-1 bg-green-600 text-white py-2.5 rounded-xl hover:bg-green-700 transition flex items-center justify-center shadow">
                    <i class="fas fa-download mr-2"></i>
                    <span>Download</span>
                  </button>
                  <button class="flex-1 bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition flex items-center justify-center shadow">
                    <i class="fas fa-share-alt mr-2"></i>
                    <span>Share</span>
                  </button> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Photo Counter -->
    <div class="text-center mt-6">
      <div class="inline-flex items-center bg-black/50 text-white rounded-full px-6 py-2 backdrop-blur-sm">
        <i class="fas fa-image mr-2 text-green-300"></i>
        <span id="photoCounter" class="font-medium"></span>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('photoCarousel');
    const scrollLeftBtn = document.getElementById('scrollLeft');
    const scrollRightBtn = document.getElementById('scrollRight');
    const pauseBtn = document.getElementById('pauseAnimation');
    const playBtn = document.getElementById('playAnimation');
    const speedSelect = document.getElementById('animationSpeed');
    const lightboxModal = document.getElementById('lightboxModal');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxDescription = document.getElementById('lightboxDescription');
    const lightboxDate = document.getElementById('lightboxDate');
    const photoCounter = document.getElementById('photoCounter');
    const closeLightbox = document.getElementById('closeLightbox');
    const prevPhoto = document.getElementById('prevPhoto');
    const nextPhoto = document.getElementById('nextPhoto');
    
    // Get all photo items
    const photoItems = document.querySelectorAll('.photo-item');
    let currentPhotoIndex = 0;
    const photos = Array.from(photoItems);
    
    // Manual scroll controls
    scrollLeftBtn.addEventListener('click', () => {
      carousel.scrollBy({ left: -400, behavior: 'smooth' });
    });
    
    scrollRightBtn.addEventListener('click', () => {
      carousel.scrollBy({ left: 400, behavior: 'smooth' });
    });
    
    // Animation controls
    pauseBtn.addEventListener('click', () => {
      document.querySelectorAll('.animate-scroll-right, .animate-scroll-left').forEach(el => {
        el.style.animationPlayState = 'paused';
      });
      pauseBtn.classList.remove('bg-green-600');
      pauseBtn.classList.add('bg-gray-400');
      playBtn.classList.remove('bg-gray-400');
      playBtn.classList.add('bg-emerald-500');
    });
    
    playBtn.addEventListener('click', () => {
      document.querySelectorAll('.animate-scroll-right, .animate-scroll-left').forEach(el => {
        el.style.animationPlayState = 'running';
      });
      playBtn.classList.remove('bg-emerald-500');
      playBtn.classList.add('bg-gray-400');
      pauseBtn.classList.remove('bg-gray-400');
      pauseBtn.classList.add('bg-green-600');
    });
    
    // Speed controls
    speedSelect.addEventListener('change', function() {
      const speed = this.value;
      let durationRight = '40s';
      let durationLeft = '45s';
      
      if (speed === 'slow') {
        durationRight = '60s';
        durationLeft = '65s';
      } else if (speed === 'fast') {
        durationRight = '25s';
        durationLeft = '30s';
      }
      
      document.querySelectorAll('.animate-scroll-right').forEach(el => {
        el.style.animationDuration = durationRight;
      });
      
      document.querySelectorAll('.animate-scroll-left').forEach(el => {
        el.style.animationDuration = durationLeft;
      });
    });
    
    // Lightbox functionality
    photoItems.forEach((item, index) => {
      item.addEventListener('click', () => {
        currentPhotoIndex = index;
        openLightbox();
      });
    });
    
    function openLightbox() {
      const photo = photos[currentPhotoIndex];
      const img = photo.querySelector('img');
      const title = photo.querySelector('h3').textContent;
      const description = photo.querySelector('.text-sm.leading-relaxed') ? 
                         photo.querySelector('.text-sm.leading-relaxed').textContent : '';
      const date = photo.querySelector('.text-green-300.text-sm').textContent;
      
      lightboxImage.src = img.src;
      lightboxImage.alt = img.alt;
      lightboxTitle.textContent = title;
      lightboxDescription.textContent = description;
      lightboxDate.textContent = date;
      photoCounter.textContent = `${currentPhotoIndex + 1} of ${photos.length} Photos`;
      
      lightboxModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
    
    function closeLightboxFunc() {
      lightboxModal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    }
    
    function showNextPhoto() {
      currentPhotoIndex = (currentPhotoIndex + 1) % photos.length;
      openLightbox();
    }
    
    function showPrevPhoto() {
      currentPhotoIndex = (currentPhotoIndex - 1 + photos.length) % photos.length;
      openLightbox();
    }
    
    closeLightbox.addEventListener('click', closeLightboxFunc);
    nextPhoto.addEventListener('click', showNextPhoto);
    prevPhoto.addEventListener('click', showPrevPhoto);
    
    // Keyboard navigation for lightbox
    document.addEventListener('keydown', (e) => {
      if (!lightboxModal.classList.contains('hidden')) {
        if (e.key === 'Escape') closeLightboxFunc();
        if (e.key === 'ArrowRight') showNextPhoto();
        if (e.key === 'ArrowLeft') showPrevPhoto();
      }
    });
    
    // Close lightbox when clicking on backdrop
    lightboxModal.addEventListener('click', (e) => {
      if (e.target === lightboxModal) {
        closeLightboxFunc();
      }
    });
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
    animation: scroll-right 40s linear infinite;
  }

  .animate-scroll-left {
    animation: scroll-left 45s linear infinite;
  }

  /* Pause animation when hovered */
  .group:hover .animate-scroll-right,
  .group:hover .animate-scroll-left {
    animation-play-state: paused;
  }

  /* Enhanced hover effects */
  .photo-item {
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  }
  
  .photo-item:hover {
    transform: translateY(-12px) scale(1.02);
  }
  
  /* Lightbox animations */
  #lightboxModal {
    animation: fadeIn 0.4s ease;
  }
  
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  
  /* Gradient text animation */
  .bg-gradient-to-r {
    background-size: 200% 200%;
    animation: gradientShift 3s ease infinite;
  }
  
  @keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
  
  /* Responsive adjustments */
  @media (max-width: 768px) {
    .flex.gap-8 {
      gap: 1.5rem;
    }
    
    .w-80 {
      width: 18rem;
    }
    
    .h-72 {
      height: 16rem;
    }
    
    #scrollLeft, #scrollRight {
      padding: 0.75rem;
      transform: scale(0.8);
    }
    
    .text-5xl {
      font-size: 2.5rem;
    }
  }
  
  /* Custom scrollbar for browsers that support it */
  ::-webkit-scrollbar {
    width: 8px;
  }
  
  ::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }
  
  ::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #10b981, #059669);
    border-radius: 10px;
  }
  
  ::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #059669, #047857);
  }
</style>
@endsection