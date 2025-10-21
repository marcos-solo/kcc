<!DOCTYPE html>
<html lang="en" x-data="{ sidebar: false }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'KCCWG')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="icon" href="{{ asset('images/logo.png') }}">
  <style>
    html { scroll-behavior: smooth; }

    /* Navbar hover */
    nav a {
      transition: all 0.3s ease;
    }
    nav a:hover, .dropdown a:hover {
      background-color: #16a34a !important;
      color: white !important;
      transform: scale(1.05);
    }

    /* Dropdown styling */
    .dropdown {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background: white;
      border-radius: 0.75rem;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      padding: 0.75rem 0;
      z-index: 50;
      min-width: 230px;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-green-50 via-white to-green-100 text-gray-900 antialiased overflow-x-hidden">

  <!-- 🌿 NAVBAR -->
  <header class="fixed top-0 left-0 w-full z-50 bg-white/90 backdrop-blur-md shadow-md border-b border-green-100">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-3">
      <!-- Logo -->
      <a href="{{ url('/') }}" class="flex items-center gap-2">
        <img src="{{ asset('images/kcclogo.jpeg') }}" alt="KCCWG Logo" class="h-10 w-10 rounded-full shadow-md">
        <span class="text-xl font-bold text-green-700 tracking-wide">KCCWG</span>
      </a>

    <!-- 🌐 Desktop Navbar -->
    <nav class="hidden md:flex gap-2 text-[13px] font-semibold uppercase tracking-wide items-center">
        <a href="{{ route('home') }}" class="px-3 py-2 rounded-full text-gray-700">Home</a>
        <a href="{{ route('about') }}" class="px-3 py-2 rounded-full text-gray-700">About</a>
        
        <a href="{{ route('projects.index') }}" class="px-3 py-2 rounded-full text-gray-700">Projects</a>


        <!-- Media & Resources Sticky Dropdown -->
        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
            <button class="px-3 py-2 rounded-full text-gray-700 flex items-center gap-1">
                Media & Resources
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div
                x-show="open"
                x-transition
                class="absolute left-0 mt-1 bg-white shadow-lg rounded-xl min-w-[220px] z-50"
            >
                <a href="{{ route('media.publications') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white">Publications</a>
                <a href="{{ route('media.reports') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white">Reports & Policy Briefs</a>
                <a href="{{ route('media.photos') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white">Photo Gallery</a>
                <a href="{{ route('media.videos') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-600 hover:text-white">Video Library</a>
            </div>
        </div>

        <a href="{{ route('campaigns') }}" class="px-3 py-2 rounded-full text-gray-700">Campaigns</a>
        <a href="{{ route('get-involved') }}" class="px-3 py-2 rounded-full text-gray-700">Get Involved</a>
        <a href="{{ route('events') }}" class="px-3 py-2 rounded-full text-gray-700">Events</a>
        <a href="{{ route('donate') }}" class="px-3 py-2 rounded-full text-gray-700">Donate</a>
        <a href="{{ route('news') }}" class="px-3 py-2 rounded-full text-gray-700">News</a>
        <a href="{{ route('contact') }}" class="px-3 py-2 rounded-full text-gray-700">Contact</a>
    </nav>


      <!-- 📱 Mobile Toggle -->
      <button @click="sidebar = true" class="md:hidden text-green-700 hover:text-green-800 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
  </header>

<!-- 📱 Mobile Sidebar -->
<div x-show="sidebar" class="fixed inset-0 z-50 flex bg-black/40" @click.self="sidebar = false">
  <aside
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="-translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="-translate-x-full opacity-0"
    class="bg-white w-72 h-full p-6 space-y-4 border-r border-green-100 rounded-r-3xl shadow-2xl overflow-y-auto"
  >
    <div class="flex justify-between items-center mb-6">
      <span class="text-lg font-bold text-green-700">Navigation</span>
      <button @click="sidebar = false" class="text-gray-500 hover:text-green-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Sidebar Links -->
    <template x-for="item in [
      {name:'Home',url:'{{ route('home') }}'},
      {name:'About',url:'{{ route('about') }}'},
      {name:'Projects',url:'{{ route('projects.index') }}'},
      {name:'Media & Resources',submenu:[
        {name:'Publications',url:'{{ route('media.publications') }}'},
        {name:'Reports & Policy Briefs',url:'{{ route('media.reports') }}'},
        {name:'Photo Gallery',url:'{{ route('media.photos') }}'},
        {name:'Video Library',url:'{{ route('media.videos') }}'}
      ]},
      {name:'Campaigns',url:'{{ route('campaigns') }}'},
      {name:'Get Involved',url:'{{ route('get-involved') }}'},
      {name:'Events',url:'{{ route('events') }}'},
      {name:'Donate',url:'{{ route('donate') }}'},
      {name:'News',url:'{{ route('news') }}'},
      {name:'Contact',url:'{{ route('contact') }}'}
    ]" :key="item.name">
      <div x-data="{ open: false }" class="space-y-1">
        <a
          :href="item.submenu ? 'javascript:void(0)' : item.url"
          @click="item.submenu ? open = !open : sidebar = false"
          class="flex justify-between items-center px-4 py-2 bg-green-50 text-green-700 font-semibold rounded-full hover:bg-green-600 hover:text-white transition"
        >
          <span x-text="item.name"></span>
          <svg x-show="item.submenu" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </a>
        <div x-show="open" x-transition class="ml-6 flex flex-col space-y-1">
          <template x-for="sub in item.submenu ?? []" :key="sub.name">
            <a :href="sub.url" @click="sidebar=false" class="px-4 py-2 rounded-full bg-green-100 text-green-700 hover:bg-green-600 hover:text-white transition" x-text="sub.name"></a>
          </template>
        </div>
      </div>
    </template>
  </aside>
</div>


  <!-- 📄 MAIN CONTENT -->
  <main class="pt-24 md:pl-0 px-4 transition-all duration-300">
    <div class="max-w-6xl mx-auto bg-white/90 rounded-2xl p-8 md:p-10 shadow-lg">
      @yield('content')
    </div>
  </main>

  <!-- 🌍 FOOTER -->
  <footer class="bg-green-900 text-white py-12 mt-16 border-t border-green-700">
    <div class="max-w-6xl mx-auto grid md:grid-cols-4 gap-10 px-6 text-sm">
      <div>
        <h4 class="font-bold text-lg mb-3">About KCCWG</h4>
        <p class="text-gray-300">
          The Kenya Climate Change Working Group promotes climate justice, sustainability, and resilience through advocacy, research, and partnerships.
        </p>
      </div>
      <div>
        <h4 class="font-bold text-lg mb-3">Quick Links</h4>
        <ul class="space-y-2 text-gray-300">
          <li><a href="{{ route('about') }}" class="hover:text-green-400">About</a></li>
          <li><a href="{{ route('projects.index') }}" class="px-3 py-2 rounded-full text-gray-700">Projects</a></li>
          <li><a href="{{ route('events') }}" class="hover:text-green-400">Events</a></li>
          <li><a href="{{ route('contact') }}" class="hover:text-green-400">Contact</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold text-lg mb-3">Newsletter</h4>
        <p class="text-gray-300 mb-3">Stay informed about climate action in Kenya.</p>
        <form class="flex newsletter">
          <input type="email" placeholder="Your email address" class="text-gray-800 px-3 py-2 rounded-l-full w-full focus:outline-none">
          <button class="bg-green-600 text-white px-4 rounded-r-full hover:bg-green-700">→</button>
        </form>
      </div>
      <div>
        <h4 class="font-bold text-lg mb-3">Our Partners</h4>
        <div class="flex flex-wrap gap-4 items-center">
          <img src="{{ asset('images/partner1.png') }}" class="h-10" alt="Partner 1">
          <img src="{{ asset('images/partner2.png') }}" class="h-10" alt="Partner 2">
          <img src="{{ asset('images/partner3.png') }}" class="h-10" alt="Partner 3">
        </div>
      </div>
    </div>
    <div class="text-center text-gray-400 mt-10 text-xs tracking-wide">
      © {{ date('Y') }} Kenya Climate Change Working Group — All Rights Reserved.
    </div>
  </footer>
</body>
</html>
