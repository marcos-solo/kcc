@extends('layouts.app')

@section('title', 'Donate | KCCWG')

@section('content')
<section class="py-16 bg-gradient-to-b from-green-50 via-white to-green-100 min-h-screen flex items-center justify-center">
  <div class="max-w-5xl mx-auto text-center px-6">
    <!-- Header -->
    <h1 class="text-4xl font-extrabold text-green-700 mb-4">Support Our Climate Action</h1>
    <p class="text-gray-700 mb-10 text-lg leading-relaxed">
      Every contribution helps us restore ecosystems, empower communities, and advocate for a greener Kenya.
    </p>

    <!-- Donation Box -->
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md mx-auto border border-green-100">
      <h3 class="text-2xl font-semibold text-green-700 mb-6">Donate via M-Pesa</h3>

      <!-- Donation Form -->
      <form id="donationForm" class="space-y-5" method="POST" action="{{ route('donate.stkpush') }}">
        @csrf

        <div class="text-left">
          <label class="block text-gray-600 text-sm font-medium mb-1">Amount (KES)</label>
          <input 
            type="number" 
            name="amount" 
            placeholder="Enter Amount (KES)"
            min="10" 
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
          >
        </div>

        <div class="text-left">
          <label class="block text-gray-600 text-sm font-medium mb-1">M-Pesa Phone Number</label>
          <input 
            type="tel" 
            name="phone" 
            placeholder="e.g. 2547XXXXXXXX"
            pattern="2547\d{8}"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
          >
        </div>

        <button 
          type="submit" 
          class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 active:bg-green-800 transition"
        >
          Donate with M-Pesa
        </button>
      </form>

      <p class="text-xs text-gray-500 mt-3">
        Your contribution is processed securely via M-Pesa (Sandbox for testing).
      </p>

      <!-- Response Message -->
      <div id="responseMessage" class="mt-5 text-sm text-gray-600"></div>
    </div>
  </div>
</section>

<!-- JS Section -->
<script>
document.getElementById('donationForm').addEventListener('submit', async (e) => {
  e.preventDefault();

  const form = e.target;
  const responseBox = document.getElementById('responseMessage');
  const data = new FormData(form);

  responseBox.textContent = "Processing donation... Please wait.";

  try {
    const res = await fetch(form.action, {
      method: 'POST',
      body: data,
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    });

    const result = await res.json();
    console.log(result);

    if (result.error) {
      responseBox.innerHTML = `<span class="text-red-600">${result.error}</span>`;
    } else if (result.ResponseDescription) {
      responseBox.innerHTML = `<span class="text-green-700 font-medium">${result.ResponseDescription}</span>`;
    } else {
      responseBox.innerHTML = `<span class="text-green-700 font-medium">Donation initiated successfully. Check your M-Pesa phone prompt (Sandbox simulation).</span>`;
    }
  } catch (error) {
    console.error(error);
    responseBox.innerHTML = `<span class="text-red-600">An error occurred. Please try again.</span>`;
  }
});
</script>
@endsection
