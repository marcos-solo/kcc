@extends('layouts.app')

@section('title', 'Projects - KCCWG')

@section('content')
<style>
/* 🌟 GOLD GRADIENT TEXT */
.gold-text {
  background: linear-gradient(90deg, #b8860b, #ffd700, #daa520, #ffcc00);
  background-size: 300%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: goldShine 6s linear infinite;
}
@keyframes goldShine {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* 🌍 Section Styling */
section {
  position: relative;
  overflow: hidden;
}
section .section-title {
  position: relative;
  font-size: 2.5rem;
  font-weight: 800;
  text-align: center;
  margin-bottom: 3rem;
  text-transform: uppercase;
  letter-spacing: 1px;
}
section .section-title::after {
  content: '';
  position: absolute;
  left: 50%;
  bottom: -10px;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  border-radius: 2px;
  background: linear-gradient(to right, #16a34a, #b8860b);
}

/* 🧭 Project Card */
.project-card {
  background: white;
  border-radius: 1rem;
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
  transition: all 0.5s ease;
  overflow: hidden;
  transform: translateY(30px);
  opacity: 0;
}
.project-card.visible {
  transform: translateY(0);
  opacity: 1;
}
.project-card:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 20px 40px rgba(0,128,0,0.15);
}
.project-card img {
  width: 100%;
  height: 220px;
  object-fit: cover;
}
.project-card .content {
  padding: 1.5rem;
  text-align: left;
}

/* 🪴 Focus Areas */
.focus-card {
  border-radius: 1rem;
  background: linear-gradient(145deg, #ffffff, #e8f5e9);
  box-shadow: 0 8px 20px rgba(0,128,0,0.08);
  padding: 2rem;
  transition: all 0.4s ease;
  transform: scale(0.95);
  opacity: 0;
}
.focus-card.visible {
  transform: scale(1);
  opacity: 1;
}
.focus-card:hover {
  transform: scale(1.05);
  background: linear-gradient(145deg, #e8f5e9, #ffffff);
}

/* 🎯 SDG */
.sdg img {
  height: 70px;
  width: 70px;
  transition: transform 0.4s ease, box-shadow 0.3s ease;
  border-radius: 0.5rem;
}
.sdg img:hover {
  transform: scale(1.15);
  box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

/* 🌠 Scroll animations */
.fade-up {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.8s ease;
}
.fade-up.visible {
  opacity: 1;
  transform: translateY(0);
}

/* 💫 Floating glow for hero */
@keyframes floatGlow {
  0%,100% { transform: translateY(0); filter: brightness(1); }
  50% { transform: translateY(-8px); filter: brightness(1.1); }
}

/* 🌿 Green accent button */
.btn-green {
  background: linear-gradient(90deg, #166534, #16a34a);
  color: white;
  font-weight: 600;
  padding: 0.75rem 2rem;
  border-radius: 9999px;
  transition: all 0.3s ease;
}
.btn-green:hover {
  background: linear-gradient(90deg, #15803d, #22c55e);
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(34,197,94,0.3);
}
</style>

<!-- 🌍 HERO -->
<section class="relative text-center text-white py-28 overflow-hidden bg-gradient-to-r from-green-900 to-green-700">
  <div class="absolute inset-0">
    <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1600&q=80"
      alt="Projects Background" class="absolute inset-0 w-full h-full object-cover brightness-50 animate-[floatGlow_10s_ease-in-out_infinite]">
  </div>
  <div class="relative z-10">
    <h1 class="text-5xl md:text-6xl font-extrabold mb-4 gold-text fade-up">Our Projects & Programs</h1>
    <p class="max-w-3xl mx-auto text-lg md:text-xl text-green-100 fade-up" style="animation-delay: 0.2s;">
      Empowering communities and protecting the environment through impactful climate initiatives.
    </p>
    <div class="mt-8 flex justify-center gap-6 fade-up" style="animation-delay: 0.4s;">
      <a href="#ongoing-projects" class="btn-green">Start Your Journey</a>
      <a href="#" class="text-green-100 hover:text-white underline font-semibold">Watch Our Story</a>
    </div>
  </div>
</section>

<!-- 🕊️ ONGOING PROJECTS -->
<section id="ongoing-projects" class="py-24 bg-gray-50">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="section-title gold-text">Ongoing Projects</h2>

    @if($ongoingProjects->count())
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
        @foreach($ongoingProjects as $project)
          <div class="project-card fade-up">
            @if($project->image)
              <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}">
            @else
              <img src="https://via.placeholder.com/400x250?text=No+Image" alt="No image">
            @endif
            <div class="content">
              <h3 class="text-xl font-bold text-green-800 mb-2">{{ $project->title }}</h3>
              <p class="text-gray-600 text-sm mb-3">{{ Str::limit($project->description, 120) }}</p>
              @if($project->pdf)
                <a href="{{ asset('storage/'.$project->pdf) }}" target="_blank" 
                   class="text-green-700 underline text-sm font-semibold">View Project PDF</a>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-center text-gray-600 italic">No ongoing projects available at the moment.</p>
    @endif
  </div>
</section>

<!-- 🌿 PAST PROJECTS -->
<section class="py-24 bg-white">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="section-title gold-text">Past Projects & Lessons Learned</h2>

    @if($pastProjects->count())
      <div class="space-y-20">
        @foreach($pastProjects as $index => $project)
          <div class="flex flex-col md:flex-row {{ $index % 2 == 1 ? 'md:flex-row-reverse' : '' }} items-center gap-10 fade-up">
            <div class="flex justify-center w-full md:w-1/2">
              @if($project->image)
                <img src="{{ asset('storage/'.$project->image) }}" class="w-96 h-64 object-cover rounded-2xl shadow-lg">
              @else
                <img src="https://via.placeholder.com/400x250?text=No+Image" class="w-96 h-64 object-cover rounded-2xl shadow-lg">
              @endif
            </div>
            <div class="md:w-1/2">
              <h3 class="text-2xl font-bold text-green-800 mb-3">{{ $project->title }}</h3>
              <p class="text-gray-700 mb-4 leading-relaxed">{{ $project->description }}</p>
              @if($project->pdf)
                <a href="{{ asset('storage/'.$project->pdf) }}" target="_blank" 
                   class="text-green-700 underline text-sm font-semibold">View Project Report (PDF)</a>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-center text-gray-600 italic">No past projects available at the moment.</p>
    @endif
  </div>
</section>

<!-- 🌾 FOCUS AREAS -->
<section class="bg-green-50 py-24">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="section-title gold-text">Our Focus Areas</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
      @foreach([
        ['🌿','Climate Change Adaptation'],
        ['🌳','Reforestation & Restoration'],
        ['🔥','Youth Climate Action'],
        ['💧','Water & Food Security'],
        ['📜','Climate Policy & Advocacy'],
        ['⚡','Renewable Energy & Innovation']
      ] as $focus)
      <div class="focus-card">
        <div class="text-5xl mb-3">{{ $focus[0] }}</div>
        <h3 class="text-xl font-semibold text-green-800">{{ $focus[1] }}</h3>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- 🌎 RELATED SDGs -->
<section class="bg-white py-24 text-center">
  <h2 class="section-title gold-text">Aligned with the UN Sustainable Development Goals</h2>
  <div class="sdg flex flex-wrap justify-center gap-6 mt-10">
    @foreach(range(6,15) as $i)
      <img src="https://sdgs.un.org/sites/default/files/styles/sdg_image/public/2020-09/E_SDG_Icons-{{ $i }}.jpg" alt="SDG {{ $i }}">
    @endforeach
  </div>
</section>

<script>
// 🪄 Animate elements when they enter viewport
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) entry.target.classList.add('visible');
  });
}, { threshold: 0.2 });

document.querySelectorAll('.fade-up, .focus-card, .project-card').forEach(el => observer.observe(el));
</script>
@endsection
