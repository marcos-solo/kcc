<!DOCTYPE html>
<html lang="en" x-data="{ sidebar: false }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Panel')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="icon" href="{{ asset('images/kcclogo.jpeg') }}">
</head>
<body class="bg-gray-100">

<!-- 🌑 Mobile Sidebar Overlay -->
<div x-show="sidebar" 
     class="fixed inset-0 z-40 bg-black/40 md:hidden" 
     @click.self="sidebar = false"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <!-- 📱 Mobile Sidebar -->
    <aside class="fixed top-0 left-0 h-full w-64 bg-green-600 text-white flex flex-col z-50
                  -translate-x-64 transform transition-transform duration-300"
           :class="{'translate-x-0': sidebar}">
        <div class="p-6 text-center border-b border-green-500">
            <img src="{{ asset('images/kcclogo.jpeg') }}" class="h-12 w-12 mx-auto mb-2 rounded-full">
            <h1 class="text-xl font-bold">KCCWG Admin</h1>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" 
               class="block py-2 px-4 rounded hover:bg-green-700 {{ request()->routeIs('admin.dashboard') ? 'bg-green-700' : '' }}">
               Dashboard
            </a>

            <a href="{{ route('admin.analytics') }}" 
               class="block py-2 px-4 rounded hover:bg-green-700 {{ request()->routeIs('admin.analytics') ? 'bg-green-700' : '' }}">
               Analytics
            </a>

            <a href="{{ route('admin.media.index') }}" 
               class="block py-2 px-4 rounded hover:bg-green-700 {{ request()->routeIs('admin.media.*') ? 'bg-green-700' : '' }}">
               Manage Media
            </a>

            <a href="{{ route('admin.projects.index') }}" 
               class="block py-2 px-4 rounded hover:bg-green-700 {{ request()->routeIs('admin.projects.*') ? 'bg-green-700' : '' }}">
               Manage Projects
            </a>

            <!-- 👥 Manage Team Button -->
            <a href="{{ route('admin.team.index') }}" 
               class="block py-2 px-4 rounded hover:bg-green-700 {{ request()->routeIs('admin.team.*') ? 'bg-green-700' : '' }}">
               Manage Team
            </a>
                    <!-- 📰 Manage News -->
        <a href="{{ route('admin.news.index') }}" 
        class="block py-2 px-4 rounded hover:bg-green-700 {{ request()->routeIs('admin.news.*') ? 'bg-green-700' : '' }}">
        Manage News
        </a>
        </nav>

        <div class="p-4 border-t border-green-500">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 rounded">
                    Logout
                </button>
            </form>
        </div>
    </aside>
</div>

<!-- 🖥️ Desktop Navbar -->
<header class="hidden md:flex fixed top-0 left-0 right-0 z-40 bg-green-600 text-white h-16 items-center justify-between px-8 shadow">
    <div class="flex items-center gap-4">
        <img src="{{ asset('images/kcclogo.jpeg') }}" class="h-10 w-10 rounded-full">
        <span class="font-bold text-lg">KCCWG Admin</span>
    </div>

    <nav class="flex gap-4 items-center">
        <a href="{{ route('admin.dashboard') }}" 
           class="px-4 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.dashboard') ? 'bg-green-700' : '' }}">
           Dashboard
        </a>

        <a href="{{ route('admin.analytics') }}" 
           class="px-4 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.analytics') ? 'bg-green-700' : '' }}">
           Analytics
        </a>

        <a href="{{ route('admin.media.index') }}" 
           class="px-4 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.media.*') ? 'bg-green-700' : '' }}">
           Media
        </a>

        <a href="{{ route('admin.projects.index') }}" 
           class="px-4 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.projects.*') ? 'bg-green-700' : '' }}">
           Projects
        </a>

        <!-- 👥 Team Link -->
        <a href="{{ route('admin.team.index') }}" 
           class="px-4 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.team.*') ? 'bg-green-700' : '' }}">
           Team
        </a>
        <a href="{{ route('admin.events.index') }}" 
        class="block py-2 px-4 rounded hover:bg-green-700 {{ request()->routeIs('admin.events.*') ? 'bg-green-700' : '' }}">
        Manage Events
        </a>
        <!-- 📰 Manage News -->
        <a href="{{ route('admin.news.index') }}" 
        class="block py-2 px-4 rounded hover:bg-green-700 {{ request()->routeIs('admin.news.*') ? 'bg-green-700' : '' }}">
        Manage News
        </a>



        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 rounded bg-red-600 hover:bg-red-700">
                Logout
            </button>
        </form>
    </nav>
</header>


<!-- 📄 Main Content -->
<main class="pt-16 md:pt-20 md:ml-0 p-8 transition-all duration-300">
    <div class="max-w-6xl mx-auto bg-white/90 rounded-2xl p-8 shadow-lg">
        @yield('content')
    </div>
</main>

</body>
</html>
