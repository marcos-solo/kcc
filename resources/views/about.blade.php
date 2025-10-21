@extends('layouts.app')

@section('title', 'About Us - KCCWG')

@section('content')
<style>
/* 🌿 Fancy gradient text */
.fancy-text {
  background: linear-gradient(90deg, #d3f8e2ff, #00b35a, #11f84bff, #cde7d7ff);
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

/* 🌍 Hero background */
.hero-about {
  background: linear-gradient(to right, rgba(153, 81, 14, 0.9), rgba(3, 41, 22, 0.86)),
              url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1400&q=80');
  background-size: cover;
  background-position: center;
}

/* 👥 Team grid */
.team-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

.team-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 107, 43, 0.2);
}

/* 🤝 Partner logos */
.partner-logo {
  filter: grayscale(100%);
  transition: all 0.3s ease;
  max-height: 70px;
  object-fit: contain;
}
.partner-logo:hover {
  filter: grayscale(0%);
  transform: scale(1.1);
}

/* ✨ Fade animation */
.fade-in {
  opacity: 0;
  transform: translateY(20px);
  animation: fadeUp 1s ease forwards;
}
@keyframes fadeUp {
  100% { opacity: 1; transform: translateY(0); }
}

/* Organization Chart Styles - RESPONSIVE */
.org-chart {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  width: 100%;
  overflow-x: auto;
  padding: 10px;
}

.org-level {
  display: flex;
  justify-content: center;
  margin-bottom: 30px;
  position: relative;
  flex-wrap: wrap;
}

.org-level::before {
  content: '';
  position: absolute;
  top: -15px;
  left: 50%;
  width: 2px;
  height: 15px;
  background-color: #00b35a;
  transform: translateX(-50%);
}

.org-node {
  background: white;
  border: 2px solid #00b35a;
  border-radius: 8px;
  padding: 10px 12px;
  text-align: center;
  min-width: 140px;
  max-width: 200px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  position: relative;
  z-index: 1;
  margin: 5px;
}

.org-node:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 12px rgba(0, 179, 90, 0.2);
  background-color: #f0fff8;
}

.org-node.primary {
  background: linear-gradient(135deg, #00b35a, #008c46);
  color: white;
  font-weight: bold;
  border-width: 3px;
  min-width: 160px;
}

.org-node.primary:hover {
  background: linear-gradient(135deg, #008c46, #006633);
}

.org-node h3 {
  margin: 0;
  font-size: 0.9rem;
  font-weight: 600;
  line-height: 1.2;
}

.org-node p {
  margin: 4px 0 0;
  font-size: 0.75rem;
  opacity: 0.8;
  line-height: 1.1;
}

.org-connector {
  position: absolute;
  background-color: #00b35a;
  height: 15px;
  width: 2px;
  top: -15px;
  left: 50%;
  transform: translateX(-50%);
}

.org-children {
  display: flex;
  justify-content: center;
  gap: 15px;
  position: relative;
  flex-wrap: wrap;
}

.org-children::before {
  content: '';
  position: absolute;
  top: -15px;
  left: 50%;
  width: 80%;
  height: 2px;
  background-color: #00b35a;
  transform: translateX(-50%);
}

.org-child-node {
  position: relative;
}

.org-child-node::before {
  content: '';
  position: absolute;
  top: -15px;
  left: 50%;
  width: 2px;
  height: 15px;
  background-color: #00b35a;
  transform: translateX(-50%);
}

.org-multi-row {
  flex-direction: column;
  gap: 15px;
}

.org-multi-row .org-node {
  margin: 0 auto;
}

.org-multi-row::before {
  display: none;
}

.org-multi-row .org-child-node::before {
  height: 10px;
  top: -10px;
}

.org-chart-container {
  background: #f8fdf9;
  border-radius: 12px;
  padding: 20px 10px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
  margin: 15px 0;
  width: 100%;
  overflow: auto;
}

/* Responsive adjustments for small screens */
@media (max-width: 768px) {
  .org-level {
    margin-bottom: 20px;
  }
  
  .org-node {
    min-width: 120px;
    padding: 8px 10px;
  }
  
  .org-node.primary {
    min-width: 140px;
  }
  
  .org-node h3 {
    font-size: 0.8rem;
  }
  
  .org-node p {
    font-size: 0.7rem;
  }
  
  .org-children {
    gap: 10px;
  }
  
  .org-children::before {
    width: 90%;
  }
}

@media (max-width: 480px) {
  .org-level {
    margin-bottom: 15px;
  }
  
  .org-node {
    min-width: 100px;
    padding: 6px 8px;
  }
  
  .org-node.primary {
    min-width: 120px;
  }
  
  .org-node h3 {
    font-size: 0.75rem;
  }
  
  .org-node p {
    font-size: 0.65rem;
  }
  
  .org-children {
    gap: 8px;
  }
}

/* Modal responsive fixes */
.modal-content {
  width: 95vw;
  max-width: 1200px;
  max-height: 90vh;
  margin: 20px auto;
}

@media (max-width: 640px) {
  .modal-content {
    width: 98vw;
    margin: 10px auto;
    padding: 15px;
  }
  
  .org-chart-container {
    padding: 10px 5px;
  }
}
</style>

<!-- 🌍 HERO SECTION -->
<section class="hero-about text-white py-24 text-center relative overflow-hidden">
  <div class="container mx-auto px-6 relative z-10">
    <h1 class="text-5xl md:text-6xl font-bold mb-4 fancy-text">
      About Kenya Climate Change Working Group
    </h1>
    <p class="max-w-3xl mx-auto text-lg md:text-xl text-green-100">
      Together for a climate-resilient Kenya — uniting civil society, donors, and communities to drive real change.
    </p>

    <!-- 🧭 Organisation Structure Button -->
    <button 
      id="openOrgModal"
      class="mt-6 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-full shadow-lg transition-all duration-300">
      View Organisation Structure
    </button>
  </div>
</section>

<!-- 🏛️ Organisation Structure Modal - RESPONSIVE -->
<div id="orgModal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-2 sm:p-4">
  <div class="modal-content bg-white rounded-2xl shadow-2xl w-full relative overflow-hidden flex flex-col">
    
    <!-- Modal Header -->
    <div class="flex justify-between items-center p-4 sm:p-6 border-b border-gray-200 bg-green-50">
      <h2 class="text-xl sm:text-2xl font-bold text-green-700">
        KCCWG Organisation Structure
      </h2>
      <!-- ❌ Close Button -->
      <button id="closeOrgModal" 
        class="text-gray-500 hover:text-red-500 transition text-2xl bg-white rounded-full w-8 h-8 flex items-center justify-center shadow-sm">
        ✕
      </button>
    </div>

    <!-- Organization Chart -->
    <div class="org-chart-container flex-1 overflow-auto">
      <div class="org-chart min-w-max sm:min-w-full">
        <!-- Level 1: KCCWG AGM -->
        <div class="org-level">
          <div class="org-node primary">
            <h3>KCCWG AGM</h3>
            <p>Annual General Meeting</p>
          </div>
        </div>

        <!-- Level 2: NSC -->
        <div class="org-level">
          <div class="org-node primary">
            <h3>NSC</h3>
            <p>National Steering Committee</p>
          </div>
        </div>

        <!-- Level 3: KCCWG National Coordination -->
        <div class="org-level">
          <div class="org-node primary">
            <h3>KCCWG National Coordination</h3>
            <p>Central Coordination Unit</p>
          </div>
        </div>

        <!-- Level 4: Department Heads -->
        <div class="org-level">
          <div class="org-children">
            <div class="org-child-node">
              <div class="org-node">
                <h3>Head of Programme</h3>
                <p>Programmes Department</p>
              </div>
            </div>
            <div class="org-child-node">
              <div class="org-node">
                <h3>Head of Communications</h3>
                <p>Communications Department</p>
              </div>
            </div>
            <div class="org-child-node">
              <div class="org-node">
                <h3>Head of Admin/Finance</h3>
                <p>Administration & Finance</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Level 5: Programme Officers -->
        <div class="org-level">
          <div class="org-children org-multi-row">
            <!-- Programme Officers -->
            <div class="org-child-node">
              <div class="org-node">
                <h3>PO 1</h3>
                <p>Programme Officer</p>
              </div>
            </div>
            <div class="org-child-node">
              <div class="org-node">
                <h3>PO 2</h3>
                <p>Programme Officer</p>
              </div>
            </div>
            <div class="org-child-node">
              <div class="org-node">
                <h3>PO 3</h3>
                <p>Programme Officer</p>
              </div>
            </div>
            <div class="org-child-node">
              <div class="org-node">
                <h3>M&E Officer</h3>
                <p>Monitoring & Evaluation</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Level 5: Communications & Admin/Finance -->
        <div class="org-level">
          <div class="org-children">
            <!-- Communications -->
            <div class="org-child-node">
              <div class="org-node">
                <h3>PO Communication</h3>
                <p>Communications Officer</p>
              </div>
            </div>
            
            <!-- Admin/Finance -->
            <div class="org-child-node">
              <div class="org-node">
                <h3>PO Admin</h3>
                <p>Administration Officer</p>
              </div>
            </div>
            <div class="org-child-node">
              <div class="org-node">
                <h3>PO Finance</h3>
                <p>Finance Officer</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Level 6: External Entities -->
        <div class="org-level">
          <div class="org-children">
            <div class="org-child-node">
              <div class="org-node">
                <h3>County Networks</h3>
                <p>Regional Operations</p>
              </div>
            </div>
            <div class="org-child-node">
              <div class="org-node">
                <h3>Strategic Partners</h3>
                <p>Collaborative Organizations</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Footer -->
    <div class="p-3 sm:p-4 border-t border-gray-200 bg-green-50 text-center">
      <p class="text-sm text-gray-600">Scroll horizontally to view the complete organization structure</p>
    </div>
  </div>
</div>

<!-- 🧠 Modal Script -->
<script>
document.getElementById('openOrgModal').addEventListener('click', function() {
  document.getElementById('orgModal').classList.remove('hidden');
  document.body.style.overflow = 'hidden'; // Prevent background scrolling
});

document.getElementById('closeOrgModal').addEventListener('click', function() {
  document.getElementById('orgModal').classList.add('hidden');
  document.body.style.overflow = 'auto'; // Restore scrolling
});

window.addEventListener('click', function(e) {
  const modal = document.getElementById('orgModal');
  if (e.target === modal) {
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto'; // Restore scrolling
  }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.getElementById('orgModal').classList.add('hidden');
    document.body.style.overflow = 'auto'; // Restore scrolling
  }
});
</script>

<!-- 🏛️ WHO WE ARE -->
<section class="py-16 bg-white">
  <div class="container mx-auto px-6">
    <h2 class="text-4xl font-bold text-green-700 mb-6 text-center fancy-text">Who We Are</h2>
    <p class="text-gray-700 leading-relaxed text-lg max-w-5xl mx-auto fade-in">
      The <strong>Kenya Climate Change Working Group (KCCWG)</strong> was formed in April 2009 by members of various civil society organizations 
      and donor partners to form a united front in confronting the causes and effects of climate change in Kenya, Africa, and beyond.
      <br><br>
      Our mission is rooted in addressing livelihood threats posed by climate change, enhancing advocacy, strengthening collaboration, 
      and empowering communities. KCCWG brings together civil society, government departments, and donor partners for synergized efforts 
      toward climate justice and sustainability.
      <br><br>
      Our <strong>National Steering Committee (NSC)</strong> oversees fundraising, coordination, monitoring, and evaluation, 
      linking our members with the government and key stakeholders to maximize impact.
    </p>
  </div>
</section>

<!-- 🎯 MISSION, VISION & VALUES -->
<section class="bg-green-50 py-16">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-green-700 mb-10 fancy-text">Mission | Vision | Values</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
      <div class="bg-white p-8 rounded-2xl shadow-lg fade-in">
        <h3 class="text-2xl font-semibold text-green-700 mb-4">Our Mission</h3>
        <p class="text-gray-700">To lead in the development and implementation of climate change-sensitive policies, projects, and actions that minimize the vulnerability of communities across Kenya.</p>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-lg fade-in">
        <h3 class="text-2xl font-semibold text-green-700 mb-4">Our Vision</h3>
        <p class="text-gray-700">A people free from the vulnerabilities due to climate change and empowered to improve their livelihoods within a changing environment.</p>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-lg fade-in">
        <h3 class="text-2xl font-semibold text-green-700 mb-4">Our Values</h3>
        <ul class="text-gray-700 space-y-2 text-left">
          <li>🌱 Inclusiveness</li>
          <li>🤝 Volunteerism & Participation</li>
          <li>🌍 Unity in Diversity</li>
          <li>💚 Dignity of the Human Person</li>
          <li>🌿 Respect for Nature</li>
          <li>🔗 Networking & Collaboration</li>
          <li>📊 Transparency & Accountability</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- 🎯 OBJECTIVES -->
<section class="py-16 bg-white">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-green-700 mb-10 fancy-text">Our Objectives</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
      <div class="bg-green-50 p-8 rounded-2xl shadow-md hover:shadow-xl transition">
        <p class="text-gray-700 font-medium">Advocate for positive policy and legislative frameworks addressing climate change impacts on Kenya's development.</p>
      </div>
      <div class="bg-green-50 p-8 rounded-2xl shadow-md hover:shadow-xl transition">
        <p class="text-gray-700 font-medium">Support civil society and government participation in climate debates at local, national, regional, and global levels.</p>
      </div>
      <div class="bg-green-50 p-8 rounded-2xl shadow-md hover:shadow-xl transition">
        <p class="text-gray-700 font-medium">Reduce climate vulnerability through community-based adaptation projects and awareness programs.</p>
      </div>
    </div>
  </div>
</section>

<!-- 👥 MEET OUR TEAM -->
<section class="bg-green-50 py-16">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-green-700 mb-10 fancy-text">Meet Our Team</h2>

    @php
      $teamMembers = \App\Models\TeamMember::where('active', true)->get();
    @endphp

    @if($teamMembers->count())
      <div x-data="{ scrollLeft() { $refs.slider.scrollBy({ left: -300, behavior: 'smooth' }) }, scrollRight() { $refs.slider.scrollBy({ left: 300, behavior: 'smooth' }) } }" class="relative max-w-7xl mx-auto">
        
        <!-- ⬅️ Left Button -->
        <button @click="scrollLeft()" 
                class="absolute -left-5 top-1/2 transform -translate-y-1/2 bg-green-600 text-white p-3 rounded-full shadow-md hover:bg-green-700 hidden md:block">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
          </svg>
        </button>

        <!-- 🎠 Carousel Wrapper -->
        <div x-ref="slider" class="flex gap-8 overflow-x-auto scroll-smooth px-4 py-4 snap-x snap-mandatory scrollbar-hide">
          @foreach($teamMembers as $member)
            <div class="team-card bg-white rounded-2xl shadow-md p-6 w-64 flex-shrink-0 snap-center">
              <img src="{{ $member->image ? asset('storage/'.$member->image) : 'https://via.placeholder.com/300x300' }}" 
                   alt="{{ $member->name }}" 
                   class="rounded-full w-40 h-40 mx-auto mb-4 object-cover">
              <h3 class="text-xl font-semibold text-green-700">{{ $member->name }}</h3>
              <p class="text-gray-600">{{ $member->role }}</p>
              <p class="text-gray-500 text-sm mt-2">{{ $member->bio }}</p>
            </div>
          @endforeach
        </div>

        <!-- ➡️ Right Button -->
        <button @click="scrollRight()" 
                class="absolute -right-5 top-1/2 transform -translate-y-1/2 bg-green-600 text-white p-3 rounded-full shadow-md hover:bg-green-700 hidden md:block">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </button>
      </div>
    @else
      <p class="text-gray-600 italic">No active team members found.</p>
    @endif
  </div>
</section>

<!-- 🤝 PARTNERS & DONORS -->
<section class="py-16 bg-white">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-green-700 mb-10 fancy-text">Our Partners & Donors</h2>
    <div class="flex flex-wrap justify-center items-center gap-10 max-w-5xl mx-auto">
      <img src="https://via.placeholder.com/150x80?text=UNDP" alt="UNDP" class="partner-logo">
      <img src="https://via.placeholder.com/150x80?text=WWF" alt="WWF" class="partner-logo">
      <img src="https://via.placeholder.com/150x80?text=USAID" alt="USAID" class="partner-logo">
      <img src="https://via.placeholder.com/150x80?text=GreenPeace" alt="GreenPeace" class="partner-logo">
    </div>
  </div>
</section>

<!-- 🌱 IMPACT SECTION -->
<section class="bg-green-700 text-white py-20 text-center">
  <h2 class="text-4xl font-bold mb-10 fancy-text">Our Impact in Action</h2>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto px-6">
    <div>
      <h3 class="text-5xl font-extrabold text-white">15+</h3>
      <p class="mt-2 text-green-100">Counties Reached</p>
    </div>
    <div>
      <h3 class="text-5xl font-extrabold text-white">10,000+</h3>
      <p class="mt-2 text-green-100">Trees Planted</p>
    </div>
    <div>
      <h3 class="text-5xl font-extrabold text-white">50+</h3>
      <p class="mt-2 text-green-100">Community Projects</p>
    </div>
  </div>
</section>
@endsection