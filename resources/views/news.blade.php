@extends('layouts.app')

@section('title', 'News & Blog - KCCWG')

@section('content')
<style>
/* 🌟 GOLD ANIMATION */
.gold-text {
  background: linear-gradient(90deg, #f6e27a, #ffcc00, #e4b915, #f8d44c);
  background-size: 200%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: goldFlow 5s linear infinite;
}
@keyframes goldFlow {
  0% { background-position: 0% 50%; }
  100% { background-position: 100% 50%; }
}

/* 🌿 HERO + BASE STYLES */
.hero-wave {
  clip-path: polygon(0% 0%, 100% 0%, 100% 85%, 0% 100%);
  height: 60vh;
  min-height: 400px;
  position: relative;
  overflow: hidden;
}

.hero-wave::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(45deg, rgba(6, 95, 70, 0.9) 0%, rgba(4, 120, 87, 0.8) 50%, rgba(5, 150, 105, 0.7) 100%);
  z-index: 1;
}

/* 🎨 ENHANCED ARTICLE CARDS */
.article-card {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
  background: white;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08), 0 1px 3px rgba(0,0,0,0.05);
  border-radius: 16px;
  overflow: hidden;
  position: relative;
  border: 1px solid rgba(34, 197, 94, 0.1);
}
.article-card:hover { 
  transform: translateY(-8px) scale(1.02); 
  box-shadow: 0 12px 28px rgba(0,0,0,0.15), 0 8px 10px rgba(0,0,0,0.1);
}

/* 🌍 NEWS SLIDER STYLES */
.news-slider {
  overflow: hidden;
  position: relative;
  mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
  -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
  cursor: grab;
  padding-bottom: 1rem;
}
.news-slider:active { cursor: grabbing; }

.news-track {
  display: flex;
  gap: 1.5rem;
  width: max-content;
  animation: scrollLeft 40s linear infinite;
}

@keyframes scrollLeft {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

.news-slider:hover .news-track {
  animation-play-state: paused;
}

/* 🆕 NAVIGATION BUTTONS */
.nav-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border: none;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  z-index: 10;
  transition: all 0.3s ease;
  color: #065f46;
}

.nav-btn:hover {
  background: rgba(255, 255, 255, 1);
  transform: translateY(-50%) scale(1.1);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.nav-btn.prev {
  left: 20px;
}

.nav-btn.next {
  right: 20px;
}

.nav-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: translateY(-50%);
}

.nav-btn:disabled:hover {
  transform: translateY(-50%);
  background: rgba(255, 255, 255, 0.9);
}

/* 🆕 ENHANCED MODAL WITH NAVIGATION */
.modal-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border: none;
  width: 44px;
  height: 44px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  z-index: 60;
  transition: all 0.3s ease;
  color: #065f46;
}

.modal-nav:hover {
  background: rgba(255, 255, 255, 1);
  transform: translateY(-50%) scale(1.1);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.modal-nav.prev {
  left: 20px;
}

.modal-nav.next {
  right: 20px;
}

.modal-nav:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: translateY(-50%);
}

.modal-nav:disabled:hover {
  transform: translateY(-50%);
  background: rgba(255, 255, 255, 0.9);
}

/* 🆕 CATEGORY FILTERS */
.category-filters {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 2rem;
}

.category-btn {
  padding: 8px 16px;
  border-radius: 20px;
  background: #f0fdf4;
  color: #065f46;
  border: 1px solid #bbf7d0;
  font-size: 0.875rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
}

.category-btn:hover {
  background: #dcfce7;
  transform: translateY(-2px);
}

.category-btn.active {
  background: #065f46;
  color: white;
  border-color: #065f46;
}

/* 🆕 ENHANCED FLOATING BUTTON */
.floating-mini {
  position: fixed;
  bottom: 24px;
  right: 24px;
  background: linear-gradient(135deg, #065f46, #059669);
  color: white;
  padding: 12px 18px;
  border-radius: 30px;
  box-shadow: 0 6px 20px rgba(6, 95, 70, 0.4);
  font-weight: 600;
  font-size: 0.875rem;
  z-index: 40;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 6px;
}

.floating-mini:hover {
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 8px 25px rgba(6, 95, 70, 0.5);
}

/* 🆕 ENHANCED MODAL */
.modal-compact {
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  position: relative;
}

.modal-content {
  scrollbar-width: thin;
  scrollbar-color: #cbd5e1 transparent;
}

.modal-content::-webkit-scrollbar {
  width: 6px;
}

.modal-content::-webkit-scrollbar-track {
  background: transparent;
}

.modal-content::-webkit-scrollbar-thumb {
  background-color: #cbd5e1;
  border-radius: 3px;
}

/* �NEW BADGE STYLES */
.hero-badge {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(10px);
  padding: 8px 16px;
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.category-tag {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  color: #065f46;
  padding: 6px 12px;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 600;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
  .article-card { min-width: 260px !important; }
  .nav-btn, .modal-nav {
    width: 40px;
    height: 40px;
  }
  .nav-btn.prev, .modal-nav.prev {
    left: 10px;
  }
  .nav-btn.next, .modal-nav.next {
    right: 10px;
  }
  .category-filters {
    gap: 8px;
  }
  .category-btn {
    padding: 6px 12px;
    font-size: 0.8rem;
  }
}
</style>

@php
  $newsArticles = \App\Models\News::latest()->get();
  $categories = ['Climate', 'Policy', 'Community', 'Innovation', 'Nature'];
@endphp

<!-- 🌍 HERO SECTION -->
<section class="relative text-white hero-wave">
  <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=1200&q=80')] bg-cover bg-center z-0"></div>
  <div class="relative z-10 container mx-auto px-6 h-full flex items-center">
    <div class="text-center w-full">
      <div class="hero-badge inline-block mb-6 glow-hover">
        <span class="text-green-100 font-semibold text-sm flex items-center justify-center gap-2">
          <span class="w-2 h-2 bg-green-300 rounded-full animate-pulse"></span>
          🌿 Fresh Climate Stories
        </span>
      </div>
      <h1 class="text-4xl md:text-5xl font-bold mb-4 gold-text hero-title leading-tight">Climate News</h1>
      <p class="text-lg text-green-100 max-w-2xl mx-auto mb-8 leading-relaxed">
        Stay updated with Kenya's green revolution. <span class="gold-text font-semibold">Bite-sized stories, big impact.</span>
      </p>
    </div>
  </div>
</section>

<!-- 🆕 CATEGORY FILTERS -->
<section class="pt-12 pb-4">
  <div class="max-w-7xl mx-auto px-6">
    <div class="category-filters" id="categoryFilters">
      <button class="category-btn active" data-category="all">All News</button>
      @foreach($categories as $category)
        <button class="category-btn" data-category="{{ strtolower($category) }}">{{ $category }}</button>
      @endforeach
    </div>
  </div>
</section>

<!-- 📰 NEWS SLIDER -->
<section class="py-8 gradient-bg relative">
  <div class="max-w-7xl mx-auto px-6 text-center mb-12">
    <h2 class="text-3xl font-bold text-green-800 mb-2">
      Latest <span class="gold-text">Updates</span>
    </h2>
    <p class="text-gray-600 max-w-xl mx-auto text-sm">
      Quick reads on climate action and sustainable development
    </p>
  </div>

  <!-- Navigation Buttons -->
  <button class="nav-btn prev" id="prevBtn" disabled>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="m15 18-6-6 6-6"/>
    </svg>
  </button>
  
  <button class="nav-btn next" id="nextBtn">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="m9 18 6-6-6-6"/>
    </svg>
  </button>

  <div class="news-slider" id="newsSlider">
    <div class="news-track" id="newsTrack">
      @foreach($newsArticles as $index => $article)
        <div class="article-card min-w-[320px] md:min-w-[380px] lg:min-w-[400px]" onclick="openArticleModal({{ $index }})" data-category="{{ $categories[$index % count($categories)] }}">
          <div class="relative overflow-hidden">
            <img src="{{ $article->image ? asset('storage/'.$article->image) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=400&q=80' }}"
                 class="w-full h-48 object-cover transition-transform duration-500 hover:scale-105" alt="{{ $article->title }}">
            <div class="category-tag absolute top-3 left-3">
              {{ $categories[$index % count($categories)] }}
            </div>
          </div>
          <div class="p-6 text-left">
            <h3 class="font-bold text-green-800 mb-2 leading-tight text-lg group-hover:text-green-600 transition-colors duration-300">
              {{ Str::limit($article->title, 60) }}
            </h3>
            <p class="text-gray-600 text-sm mb-3 leading-relaxed">
              {{ Str::limit(strip_tags($article->content), 90, '...') }}
            </p>
            <div class="flex justify-between items-center text-xs text-gray-500">
              <span>{{ $article->created_at->format('M j, Y') }}</span>
              <span>{{ rand(2, 8) }} min read</span>
            </div>
          </div>
        </div>
      @endforeach

      <!-- Duplicate for infinite loop -->
      @foreach($newsArticles as $index => $article)
        <div class="article-card min-w-[320px] md:min-w-[380px] lg:min-w-[400px]" onclick="openArticleModal({{ $index }})" data-category="{{ $categories[$index % count($categories)] }}">
          <div class="relative overflow-hidden">
            <img src="{{ $article->image ? asset('storage/'.$article->image) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=400&q=80' }}"
                 class="w-full h-48 object-cover transition-transform duration-500 hover:scale-105" alt="{{ $article->title }}">
            <div class="category-tag absolute top-3 left-3">
              {{ $categories[$index % count($categories)] }}
            </div>
          </div>
          <div class="p-6 text-left">
            <h3 class="font-bold text-green-800 mb-2 leading-tight text-lg group-hover:text-green-600 transition-colors duration-300">
              {{ Str::limit($article->title, 60) }}
            </h3>
            <p class="text-gray-600 text-sm mb-3 leading-relaxed">
              {{ Str::limit(strip_tags($article->content), 90, '...') }}
            </p>
            <div class="flex justify-between items-center text-xs text-gray-500">
              <span>{{ $article->created_at->format('M j, Y') }}</span>
              <span>{{ rand(2, 8) }} min read</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- 🌱 ENHANCED NEWS MODAL WITH NAVIGATION -->
<div id="articleModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
  <!-- Navigation Buttons -->
  <button class="modal-nav prev" id="modalPrevBtn" onclick="navigateArticle(-1)">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="m15 18-6-6 6-6"/>
    </svg>
  </button>
  
  <button class="modal-nav next" id="modalNextBtn" onclick="navigateArticle(1)">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="m9 18 6-6-6-6"/>
    </svg>
  </button>

  <div class="modal-compact bg-white w-full max-w-2xl relative">
    <button onclick="closeArticleModal()" class="absolute top-4 right-4 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full w-9 h-9 flex items-center justify-center shadow-lg z-50 transition-all hover:scale-110">×</button>
    <img id="modalImage" src="" alt="Article Image" class="w-full h-52 object-cover rounded-t-lg">
    <div class="p-7 max-h-96 overflow-y-auto modal-content">
      <div class="flex justify-between items-center mb-4 text-sm text-gray-500">
        <span id="modalDate"></span>
        <span id="modalReadTime"></span>
      </div>
      <h2 id="modalTitle" class="text-2xl font-bold text-green-800 mb-4"></h2>
      <div id="modalContent" class="text-gray-700 text-sm leading-relaxed space-y-4"></div>
    </div>
  </div>
</div>

<!-- 📖 Floating Read Button -->
<div class="floating-mini animate-bounce cursor-pointer" onclick="openArticleModal(0)">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
  </svg>
  Read Latest
</div>

@php
  $articleData = $newsArticles->map(fn($a) => [
    'title' => $a->title,
    'date' => $a->created_at->format('M j, Y'),
    'image' => $a->image ? asset('storage/'.$a->image) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=400&q=80',
    'content' => $a->content,
    'readTime' => rand(2, 8) . ' min read'
  ]);
@endphp

<script>
let articles = @json($articleData);
let currentArticle = 0;
let currentCategory = 'all';

// Open Modal
function openArticleModal(index) {
  currentArticle = index;
  updateModalContent();
  document.getElementById('articleModal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
  updateModalNavButtons();
}

// Close Modal
function closeArticleModal() {
  document.getElementById('articleModal').classList.add('hidden');
  document.body.style.overflow = 'auto';
}

// Update modal content
function updateModalContent() {
  const a = articles[currentArticle];
  document.getElementById('modalImage').src = a.image;
  document.getElementById('modalTitle').textContent = a.title;
  document.getElementById('modalDate').textContent = a.date;
  document.getElementById('modalReadTime').textContent = a.readTime;
  document.getElementById('modalContent').innerHTML = a.content;
}

// Navigate between articles in modal
function navigateArticle(direction) {
  currentArticle += direction;
  
  // Loop around if at the end
  if (currentArticle < 0) {
    currentArticle = articles.length - 1;
  } else if (currentArticle >= articles.length) {
    currentArticle = 0;
  }
  
  updateModalContent();
  updateModalNavButtons();
}

// Update modal navigation buttons state
function updateModalNavButtons() {
  const prevBtn = document.getElementById('modalPrevBtn');
  const nextBtn = document.getElementById('modalNextBtn');
  
  // For modal, we always enable both buttons since we loop around
  prevBtn.disabled = false;
  nextBtn.disabled = false;
}

// Slider navigation
document.addEventListener('DOMContentLoaded', function() {
  const track = document.getElementById('newsTrack');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const slider = document.getElementById('newsSlider');
  const categoryFilters = document.getElementById('categoryFilters');
  
  let isDown = false;
  let startX;
  let scrollLeft;
  let autoScroll = true;
  
  // Calculate max scroll
  const maxScroll = track.scrollWidth - slider.clientWidth;
  
  // Update button states
  function updateButtonStates() {
    prevBtn.disabled = track.scrollLeft <= 0;
    nextBtn.disabled = track.scrollLeft >= maxScroll;
  }
  
  // Next button click
  nextBtn.addEventListener('click', function() {
    autoScroll = false;
    track.scrollBy({ left: 400, behavior: 'smooth' });
    setTimeout(updateButtonStates, 300);
  });
  
  // Previous button click
  prevBtn.addEventListener('click', function() {
    autoScroll = false;
    track.scrollBy({ left: -400, behavior: 'smooth' });
    setTimeout(updateButtonStates, 300);
  });
  
  // Track scroll events
  track.addEventListener('scroll', updateButtonStates);
  
  // Drag functionality
  track.addEventListener('mousedown', e => {
    isDown = true;
    track.classList.add('active');
    startX = e.pageX - track.offsetLeft;
    scrollLeft = track.scrollLeft;
    autoScroll = false;
  });
  
  track.addEventListener('mouseleave', () => {
    isDown = false;
    track.classList.remove('active');
  });
  
  track.addEventListener('mouseup', () => {
    isDown = false;
    track.classList.remove('active');
  });
  
  track.addEventListener('mousemove', e => {
    if(!isDown) return;
    e.preventDefault();
    const x = e.pageX - track.offsetLeft;
    const walk = (x - startX) * 2;
    track.scrollLeft = scrollLeft - walk;
    updateButtonStates();
  });
  
  // Touch events
  track.addEventListener('touchstart', e => {
    isDown = true;
    startX = e.touches[0].pageX - track.offsetLeft;
    scrollLeft = track.scrollLeft;
    autoScroll = false;
  });
  
  track.addEventListener('touchend', () => {
    isDown = false;
  });
  
  track.addEventListener('touchmove', e => {
    if(!isDown) return;
    const x = e.touches[0].pageX - track.offsetLeft;
    const walk = (x - startX) * 2;
    track.scrollLeft = scrollLeft - walk;
    updateButtonStates();
  });
  
  // Category filtering
  if (categoryFilters) {
    categoryFilters.addEventListener('click', function(e) {
      if (e.target.classList.contains('category-btn')) {
        // Update active button
        document.querySelectorAll('.category-btn').forEach(btn => {
          btn.classList.remove('active');
        });
        e.target.classList.add('active');
        
        // Get selected category
        currentCategory = e.target.getAttribute('data-category');
        
        // Filter articles
        filterArticles(currentCategory);
      }
    });
  }
  
  // Initial button state
  updateButtonStates();
});

// Filter articles by category
function filterArticles(category) {
  const articles = document.querySelectorAll('.article-card');
  
  articles.forEach(article => {
    if (category === 'all' || article.getAttribute('data-category').toLowerCase() === category) {
      article.style.display = 'block';
    } else {
      article.style.display = 'none';
    }
  });
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
  const modal = document.getElementById('articleModal');
  if (e.target === modal) {
    closeArticleModal();
  }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeArticleModal();
  }
});
</script>
@endsection