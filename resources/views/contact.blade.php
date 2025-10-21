@extends('layouts.app')

@section('title', 'Contact Us - KCCWG')

@section('content')
<style>
/* 🌿 Gold animated text */
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

/* ✨ Card hover */
.contact-card {
  transition: all 0.4s ease;
}
.contact-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}
</style>

<!-- 🌍 HERO SECTION -->
<section class="relative text-white py-24 overflow-hidden text-center">
  <img src="https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=1600&q=80"
       alt="Contact Background" class="absolute inset-0 w-full h-full object-cover brightness-75">
  <div class="absolute inset-0 bg-gradient-to-b from-green-900/80 via-black/50 to-green-800/70"></div>

  <div class="relative z-10 container mx-auto px-6">
    <h1 class="text-5xl md:text-6xl font-extrabold mb-4 gold-text">Contact Us</h1>
    <p class="max-w-3xl mx-auto text-lg md:text-xl text-green-100">
      Reach out to the Kenya Climate Change Working Group — we’d love to hear from you.
    </p>
  </div>
</section>

<!-- 📍 CONTACT DETAILS -->
<section class="bg-green-50 py-16">
  <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 px-6">
    
    <div class="bg-white p-8 rounded-2xl shadow contact-card text-center">
      <div class="text-green-700 text-4xl mb-3">📍</div>
      <h3 class="font-bold text-lg mb-2">Find Us</h3>
      <p class="text-gray-600">Block W, National Water Plaza, Dunga Road, South B</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow contact-card text-center">
      <div class="text-green-700 text-4xl mb-3">📞</div>
      <h3 class="font-bold text-lg mb-2">Call Us</h3>
      <p class="text-gray-600">+254 798 400 103</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow contact-card text-center">
      <div class="text-green-700 text-4xl mb-3">✉️</div>
      <h3 class="font-bold text-lg mb-2">Mail Us</h3>
      <p class="text-gray-600">info@kccwg.org</p>
    </div>
  </div>

  <div class="text-center mt-10 text-gray-600">
    <p><strong>Postal Code:</strong> 61912 - 00200</p>
  </div>
</section>

<!-- 💬 CONTACT FORM -->
<section class="bg-white py-20">
  <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-10 px-6 items-center">
    
    <!-- 🌿 Contact Form -->
    <div>
      <h2 class="text-3xl font-bold text-green-700 mb-6">Send Us a Message</h2>
      <form action="#" method="POST" class="space-y-5">
        @csrf
        <div>
          <label class="block text-gray-700 font-semibold mb-1">Name</label>
          <input type="text" name="name" required
                 class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div>
          <label class="block text-gray-700 font-semibold mb-1">Email</label>
          <input type="email" name="email" required
                 class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div>
          <label class="block text-gray-700 font-semibold mb-1">Message</label>
          <textarea name="message" rows="5" required
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
        </div>

        <button type="submit"
                class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition">
          Send Message
        </button>
      </form>
    </div>

    <!-- 🗺️ Google Map -->
    <div class="rounded-2xl overflow-hidden shadow-lg">
      <iframe 
        src="https://www.google.com/maps?q=National%20Water%20Plaza%20Dunga%20Road%20South%20B%20Kenya&output=embed"
        width="100%" height="400" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
</section>

<!-- 🌍 SOCIAL MEDIA LINKS -->
<section class="bg-green-800 text-white py-10 text-center">
  <h3 class="text-2xl font-semibold mb-4">Connect with Us</h3>
  <div class="flex justify-center gap-6 text-3xl">
    <a href="#" class="hover:text-green-400 transition">📘</a>
    <a href="#" class="hover:text-green-400 transition">📸</a>
    <a href="#" class="hover:text-green-400 transition">🐦</a>
    <a href="#" class="hover:text-green-400 transition">▶️</a>
    <a href="#" class="hover:text-green-400 transition">💼</a>
  </div>
</section>

<!-- 💬 FLOATING WHATSAPP BUTTON -->
<a href="https://wa.me/254798400103" target="_blank" 
   class="fixed bottom-6 right-6 bg-green-600 text-white text-3xl p-4 rounded-full shadow-lg hover:bg-green-700 transition">
   💬
</a>
@endsection
