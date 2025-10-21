@extends('layouts.app')

@section('title', 'Campaigns & Advocacy | KCCWG')

@section('content')
<section class="py-16 bg-gradient-to-b from-green-50 to-white text-gray-800">
  <!-- Header -->
  <div class="text-center mb-12">
    <h1 class="text-4xl font-extrabold text-green-700">Campaigns & Advocacy</h1>
    <p class="text-gray-600 text-lg">Driving policy change and grassroots action for Kenya’s climate resilience.</p>
  </div>

  <!-- Flash message -->
  @if (session('success'))
    <div id="pledgeSuccessPopup" class="fixed top-10 left-1/2 transform -translate-x-1/2 bg-green-600 text-white p-4 rounded-lg shadow-lg z-50">
      🎉 Congratulations! You have pledged successfully.
    </div>
  @endif

  <!-- 🌿 Live Pledge Counters -->
  <div class="max-w-6xl mx-auto mb-12 grid md:grid-cols-2 gap-6 text-center">
    <!-- Trees -->
    <div class="bg-green-100 p-6 rounded-2xl shadow">
        <h3 class="text-2xl font-bold text-green-700 mb-2">🌳 Trees Pledged</h3>
        <p class="text-gray-700 text-2xl mb-1 font-semibold">
            {{ $treePledgesCount ?? 0 }} people pledged
        </p>
        <p class="text-gray-700 text-4xl font-extrabold" id="treeCounter">{{ $totalTreesPledged ?? 0 }}</p>
        <p class="text-gray-600 mt-1 text-sm">total trees pledged</p>
    </div>

    <!-- Plastic -->
    <div class="bg-green-100 p-6 rounded-2xl shadow">
        <h3 class="text-2xl font-bold text-green-700 mb-2">🚫 Plastic Pledges</h3>
        <p class="text-gray-700 text-4xl font-extrabold" id="plasticCounter">{{ $plasticPledgesCount ?? 0 }}</p>
        <p class="text-gray-600 mt-1 text-sm">people pledged</p>
    </div>
  </div>

  <!-- Campaign Cards -->
  <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 mb-12">
    <!-- Adopt a Tree -->
    <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition">
      <h3 class="text-green-700 font-bold text-xl mb-3">🌳 Adopt a Tree Challenge</h3>
      <p class="text-gray-600 mb-4">Join individuals across Kenya pledging to plant and nurture a tree.</p>
      <button 
        onclick="openModal('treeModal')" 
        class="text-green-700 font-semibold hover:underline focus:outline-none">
        Sign Up →
      </button>
    </div>

    <!-- Stop Plastic -->
    <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition">
      <h3 class="text-green-700 font-bold text-xl mb-3">🚫 Stop Plastic Use</h3>
      <p class="text-gray-600 mb-4">Advocating for stronger enforcement of single-use plastic bans.</p>
      <button 
        onclick="openModal('plasticModal')" 
        class="text-green-700 font-semibold hover:underline focus:outline-none">
        Take the Pledge →
      </button>
    </div>
  </div>

  <!-- Policy & Petitions -->
  <div class="max-w-5xl mx-auto text-center">
    <h2 class="text-3xl font-bold text-green-700 mb-4">Policy Engagement & Petitions</h2>
    <p class="text-gray-600 mb-6">We collaborate with local and national governments to shape climate policy and mobilize citizens for change.</p>
    <button class="px-6 py-3 bg-green-600 text-white rounded-full shadow hover:bg-green-700">
      View Active Petitions
    </button>
  </div>
</section>

<!-- 🌳 Tree Challenge Modal -->
<div id="treeModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-2xl shadow-xl w-96 relative">
    <button onclick="closeModal('treeModal')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">&times;</button>
    <h3 class="text-xl font-bold text-green-700 mb-3">🌳 Adopt a Tree Challenge</h3>
    <form action="{{ route('pledges.store') }}" method="POST">
      @csrf
      <input type="hidden" name="pledge_type" value="tree_challenge">
      <div class="mb-3">
        <input type="text" name="name" placeholder="Your Name" class="w-full border p-2 rounded focus:ring-2 focus:ring-green-300" required>
      </div>
      <div class="mb-3">
        <input type="email" name="email" placeholder="Email (optional)" class="w-full border p-2 rounded focus:ring-2 focus:ring-green-300">
      </div>
      <div class="mb-3">
        <input type="number" name="quantity" placeholder="Number of Trees" class="w-full border p-2 rounded focus:ring-2 focus:ring-green-300">
      </div>
      <div class="mb-3">
        <textarea name="message" rows="3" placeholder="Your Message (optional)" class="w-full border p-2 rounded focus:ring-2 focus:ring-green-300"></textarea>
      </div>
      <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
        Submit Pledge
      </button>
    </form>
  </div>
</div>

<!-- 🚫 Stop Plastic Modal -->
<div id="plasticModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-2xl shadow-xl w-96 relative">
    <button onclick="closeModal('plasticModal')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">&times;</button>
    <h3 class="text-xl font-bold text-green-700 mb-3">🚫 Stop Plastic Use</h3>
    <form action="{{ route('pledges.store') }}" method="POST">
      @csrf
      <input type="hidden" name="pledge_type" value="stop_plastic">
      <div class="mb-3">
        <input type="text" name="name" placeholder="Your Name" class="w-full border p-2 rounded focus:ring-2 focus:ring-green-300" required>
      </div>
      <div class="mb-3">
        <input type="email" name="email" placeholder="Email (optional)" class="w-full border p-2 rounded focus:ring-2 focus:ring-green-300">
      </div>
      <div class="mb-3">
        <textarea name="message" rows="3" placeholder="Your Message (optional)" class="w-full border p-2 rounded focus:ring-2 focus:ring-green-300"></textarea>
      </div>
      <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
        Submit Pledge
      </button>
    </form>
  </div>
</div>

<!-- 🌿 Modal & Counter Script -->
<script>
  // Open/Close Modals
  function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
  }
  function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
  }

  // Animate counters
  function animateCounter(id, endValue, duration = 1500) {
    let start = 0;
    const stepTime = Math.abs(Math.floor(duration / (endValue || 1)));
    const obj = document.getElementById(id);
    let timer = setInterval(() => {
      start += 1;
      obj.textContent = start.toLocaleString();
      if (start >= endValue) clearInterval(timer);
    }, stepTime);
  }

  document.addEventListener('DOMContentLoaded', () => {
    animateCounter('treeCounter', {{ $totalTreesPledged ?? 0 }});
    animateCounter('plasticCounter', {{ $plasticPledgesCount ?? 0 }});

    // Auto-hide success popup after 3 seconds
    const popup = document.getElementById('pledgeSuccessPopup');
    if (popup) {
      setTimeout(() => popup.remove(), 3000);
    }
  });
</script>
@endsection
