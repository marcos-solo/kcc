@extends('layouts.app')

@section('title', 'Home - KCCWG')

@section('content')
<style>
/* 🌿 Fancy gradient text */
.fancy-text {
  background: linear-gradient(90deg, #006b2b, #00b35a, #2dc653, #005a24);
  background-size: 400%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: gradientFlow 6s linear infinite;
}
@keyframes gradientFlow {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* 🎞️ Torn-paper effect */
.torn-paper {
  clip-path: polygon(
    0% 0%, 100% 0%, 100% 95%, 95% 100%, 90% 95%, 85% 100%, 80% 95%, 75% 100%, 
    70% 95%, 65% 100%, 60% 95%, 55% 100%, 50% 95%, 45% 100%, 40% 95%, 35% 100%, 
    30% 95%, 25% 100%, 20% 95%, 15% 100%, 10% 95%, 5% 100%, 0% 95%
  );
}

/* 📸 3D gallery */
.deck {
  position: relative;
  width: 320px;
  height: 420px;
  perspective: 1200px;
  margin: 0 auto;
}
.deck-card {
  position: absolute;
  inset: 0;
  transition: all 0.8s ease;
  transform-origin: center;
  cursor: pointer;
}
.deck-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 1.5rem;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
  transition: transform 0.4s ease;
}
.deck-card:hover img {
  transform: scale(1.05) rotateY(10deg);
}
.deck-card .title {
  position: absolute;
  bottom: 0;
  width: 100%;
  padding: 1rem;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.75), transparent);
  color: white;
  font-weight: 600;
  text-align: center;
  border-radius: 0 0 1.5rem 1.5rem;
}

/* 💫 Fade animation */
@keyframes fadeSlideIn {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}
.hero-text { animation: fadeSlideIn 1.2s ease-out forwards; }

/* 🌎 Video container */
.video-container {
  position: relative;
  overflow: hidden;
  height: 100%;
  clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%);
}
.video-container video {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.video-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.1));
}

/* 📦 Gallery Container (Glass effect) */
.gallery-container {
  background: rgba(255, 255, 255, 0.15);
  border: 1px solid rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  padding: 2rem;
  border-radius: 1.5rem;
  box-shadow: 0 8px 20px rgba(0,0,0,0.3);
  transition: transform 0.4s ease, box-shadow 0.4s ease;
}
.gallery-container:hover {
  transform: scale(1.02);
  box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}
</style>

<!-- 🎥 HERO SECTION -->
<section class="flex flex-col md:flex-row h-[90vh] bg-white relative overflow-hidden">

  <!-- 🖼️ Video Side -->
  <div class="video-container w-full md:w-1/2 h-[50vh] md:h-full relative">
    <video autoplay muted loop playsinline class="object-cover w-full h-full">
      <source src="{{ asset('videos/kcc.mp4') }}" type="video/mp4">
    </video>
    <div class="absolute inset-0 bg-black/30"></div>

    <!-- 🌾 Floating WHAT WE DO Gallery (Smaller Version) -->
    <div 
      x-data="{ index: 0, images: [
        {src: 'https://images.unsplash.com/photo-1523978591478-c753949ff840?auto=format&fit=crop&w=700&q=80', title: 'Kenya’s Natural Beauty'},
        {src: 'https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=700&q=80', title: 'Protecting Our Forests'},
        {src: 'https://images.unsplash.com/photo-1595433562696-19e99e1b41c4?auto=format&fit=crop&w=700&q=80', title: 'Empowering Communities'}
      ]}" 
      class="absolute inset-0 flex flex-col items-center justify-center text-white z-20 px-4"
    >
      <div class="gallery-container text-center scale-90 md:scale-75">
        <h3 class="text-2xl md:text-3xl font-bold mb-4 tracking-wide fancy-text">WHAT WE DO</h3>
        <div class="deck w-[240px] md:w-[320px] h-[160px] md:h-[200px] mx-auto cursor-pointer relative"
             @click="index = (index + 1) % images.length">
          <template x-for="(img, i) in images" :key="i">
            <div class="deck-card absolute inset-0 rounded-2xl overflow-hidden transition-all duration-700 ease-in-out"
              :style="{
                transform: i === index ? 'rotateY(0deg) scale(1)' :
                          i < index ? 'rotateY(-90deg) scale(0.9)' :
                          'rotateY(90deg) scale(0.9)',
                opacity: i === index ? 1 : 0,
                zIndex: i === index ? 10 : 0
              }"
            >
              <img :src="img.src" class="torn-paper w-full h-full object-cover rounded-2xl shadow-xl">
              <div class="absolute bottom-0 left-0 w-full bg-black/40 py-2 text-center text-sm md:text-base font-medium" x-text="img.title"></div>
            </div>
          </template>
        </div>
        <p class="mt-2 text-gray-200 italic text-xs md:text-sm opacity-80">Click to reveal the next mission image</p>
      </div>
    </div>
  </div>

  <!-- 🌍 Hero Text Side -->
  <div class="flex flex-col justify-center items-center md:items-start text-center md:text-left px-8 md:px-16 w-full md:w-1/2 bg-white/90 backdrop-blur-lg relative z-10">
    <div class="hero-text max-w-lg">
      <h1 class="text-4xl md:text-5xl font-extrabold mb-4 fancy-text text-green-700">Protecting Kenya’s Climate</h1>
      <p class="text-gray-700 text-base md:text-lg mb-8 leading-relaxed">
        To participate and lead in the development and implementation of climate change sensitive policies,
         projects and activities to minimize the vulnerability of peoples due to climate change.
      </p>
      <div class="cta-buttons flex justify-center md:justify-start gap-4">
        <a href="{{ route('news') }}" 
           class="px-5 py-2.5 bg-green-600 text-white rounded-full shadow-md hover:bg-green-700 transition transform hover:-translate-y-1">
           Subscribe
        </a>
        <a href="{{ route('about') }}" 
           class="px-5 py-2.5 border border-green-700 text-green-700 rounded-full shadow-md hover:bg-green-50 transition transform hover:-translate-y-1">
           Learn More
        </a>
        <a href="{{ route('membership.create') }}"
          class="px-5 py-2.5 bg-yellow-500 text-white rounded-full shadow-md hover:bg-yellow-600 transition transform hover:-translate-y-1">
          Membership
  </a>
      </div>
    </div>
  </div>
</section>


<!-- 🌱 IMPACT STATS -->
<section class="bg-green-50 py-20 text-center">
  <h2 class="text-3xl font-bold text-green-700 mb-8 fancy-text">Our Impact in Numbers</h2>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto">
    <div class="bg-white shadow-md rounded-2xl p-8 hover:shadow-xl transition">
      <h3 class="text-5xl font-extrabold text-green-600">15+</h3>
      <p class="text-gray-700 mt-3">Counties Reached</p>
    </div>
    <div class="bg-white shadow-md rounded-2xl p-8 hover:shadow-xl transition">
      <h3 class="text-5xl font-extrabold text-green-600">10,000+</h3>
      <p class="text-gray-700 mt-3">Trees Planted</p>
    </div>
    <div class="bg-white shadow-md rounded-2xl p-8 hover:shadow-xl transition">
      <h3 class="text-5xl font-extrabold text-green-600">50+</h3>
      <p class="text-gray-700 mt-3">Community Projects</p>
    </div>
  </div>
</section>

<!-- 🌍 HIGHLIGHTS OF KEY PROGRAMS -->
<section class="py-20 bg-white">
  <div class="max-w-6xl mx-auto text-center px-6">
    <h2 class="text-4xl font-bold fancy-text mb-12">Highlights of Our Key Programs</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
      <div class="rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition">
        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=800&q=80" alt="" class="w-full h-56 object-cover">
        <div class="p-6">
          <h3 class="text-2xl font-semibold text-green-700 mb-2">Tree Restoration</h3>
          <p class="text-gray-600">Reforesting degraded lands and empowering local communities to sustain Kenya’s natural ecosystem.</p>
        </div>
      </div>
      <div class="rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition">
        <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=800&q=80" alt="" class="w-full h-56 object-cover">
        <div class="p-6">
          <h3 class="text-2xl font-semibold text-green-700 mb-2">Clean Energy Campaign</h3>
          <p class="text-gray-600">Promoting sustainable energy sources to reduce carbon emissions and empower rural homes.</p>
        </div>
      </div>
      <div class="rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition">
        <img src="https://images.unsplash.com/photo-1603048297319-ef1b7ed0d9c5?auto=format&fit=crop&w=800&q=80" alt="" class="w-full h-56 object-cover">
        <div class="p-6">
          <h3 class="text-2xl font-semibold text-green-700 mb-2">Climate Education</h3>
          <p class="text-gray-600">Building awareness and training youth leaders to become advocates for climate resilience.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 📬 NEWSLETTER SIGNUP -->
<section class="bg-green-700 py-16 text-center text-white">
  <div class="max-w-3xl mx-auto px-6">
    <h2 class="text-3xl font-bold mb-4">Join the Movement 🌍</h2>
    <p class="text-lg mb-6 opacity-90">Subscribe to our newsletter and get updates on our latest climate initiatives, events, and volunteer opportunities.</p>
    <form action="#" method="POST" class="flex flex-col md:flex-row justify-center items-center gap-4">
      <input type="email" name="email" placeholder="Enter your email" required class="w-full md:w-2/3 px-4 py-3 rounded-lg text-gray-800 focus:outline-none">
      <button type="submit" class="bg-white text-green-700 font-semibold px-6 py-3 rounded-lg hover:bg-green-100 transition">Subscribe</button>
    </form>
  </div>
</section>
@endsection
