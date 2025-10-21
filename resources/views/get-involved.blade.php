@extends('layouts.app')
@section('title', 'Get Involved | KCCWG')

@section('content')
<section class="py-16 bg-gradient-to-b from-green-50 to-white text-gray-800">
  <div class="text-center mb-12">
    <h1 class="text-4xl font-extrabold text-green-700">Get Involved</h1>
    <p class="text-gray-600 text-lg">Join our movement — as a volunteer, member, partner, or intern.</p>
  </div>

  <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">

    <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition">
      <h3 class="text-green-700 font-bold mb-2">🌱 Volunteer</h3>
      <p class="text-gray-600 mb-4">Sign up to participate in tree planting, clean-ups, and awareness drives.</p>
      <a href="#" class="text-green-700 font-semibold hover:underline">Join Now →</a>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition">
      <h3 class="text-green-700 font-bold mb-2">👥 Become a Member</h3>
      <p class="text-gray-600 mb-4">Choose from individual, corporate, or student memberships.</p>
      <a href="#" class="text-green-700 font-semibold hover:underline">Membership Form →</a>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition">
      <h3 class="text-green-700 font-bold mb-2">🤝 Partner With Us</h3>
      <p class="text-gray-600 mb-4">Collaborate with us on climate action projects and advocacy efforts.</p>
      <a href="#" class="text-green-700 font-semibold hover:underline">Contact Our Team →</a>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition">
      <h3 class="text-green-700 font-bold mb-2">🎓 Internships</h3>
      <p class="text-gray-600 mb-4">Gain experience in environmental research, media, or policy engagement.</p>
      <a href="#" class="text-green-700 font-semibold hover:underline">Apply Here →</a>
    </div>

  </div>
</section>
@endsection
