<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LMS Vokasi')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }

        /* Animasi Sidebar */
        .sidebar {
            animation: slideInLeft 0.3s ease-out;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Animasi Content */
        .main-content {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Sidebar Link Hover */
        .nav-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .nav-link:hover::before {
            left: 0;
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.2) 0%, rgba(59, 130, 246, 0) 100%);
            border-left: 4px solid #3b82f6;
            padding-left: calc(0.75rem - 4px);
        }

        /* Card Animation */
        .card {
            animation: scaleIn 0.3s ease-out;
            transition: all 0.3s ease;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* Button Animation */
        .btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            pointer-events: none;
        }

        .btn:active::after {
            width: 300px;
            height: 300px;
        }

        /* Gradient Sidebar */
        .sidebar {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        }

        /* Status Badge Animation */
        .badge {
            animation: badgePulse 2s infinite;
        }

        @keyframes badgePulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }

        /* Fade Alert */
        .alert {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Table Row Hover */
        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.05);
        }

        /* Loading Skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 2s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-gray-50 min-h-screen">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 text-white shadow-2xl flex-shrink-0 flex flex-col h-screen fixed left-0 top-0 z-50">
            <!-- Logo -->
            <div class="p-6 border-b border-blue-800">
                <div class="flex items-center space-x-3 group">
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5M6.5 10.5l3 3 5-5M16 4v5h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">LMS Vokasi</h1>
                        <p class="text-xs text-blue-200">Platform Pembelajaran</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            @auth
            <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6z"/></svg>
                        <span>Dashboard Admin</span>
                    </a>
                    <a href="{{ route('admin.users') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
                        <span>Kelola Users</span>
                    </a>
                    <a href="{{ route('admin.kelas') }}" class="nav-link {{ request()->is('admin/kelas*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/></svg>
                        <span>Kelola Kelas</span>
                    </a>

                @elseif(auth()->check() && auth()->user()->role === 'guru')
                    <a href="{{ route('guru.dashboard') }}" class="nav-link {{ request()->is('guru/dashboard') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5"/></svg>
                        <span>Dashboard Guru</span>
                    </a>
                    <a href="{{ route('guru.kelas') }}" class="nav-link {{ request()->is('guru/kelas*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/></svg>
                        <span>Kelas Saya</span>
                    </a>
                    <a href="{{ route('guru.tugas') }}" class="nav-link {{ request()->is('guru/tugas*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2H6V4a2 2 0 012-2h2a2 2 0 012 2v1h1a1 1 0 100 2h-.5v7h.5a1 1 0 100-2H6v2h1a1 1 0 100-2h-1v-1H4a2 2 0 01-2-2V5z"/></svg>
                        <span>Kelola Tugas</span>
                    </a>
                    <a href="{{ route('guru.submissions') }}" class="nav-link {{ request()->is('guru/submissions*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9zM4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"/></svg>
                        <span>Submission</span>
                    </a>

                @else
                    <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ request()->is('mahasiswa/dashboard') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('mahasiswa.kelas') }}" class="nav-link {{ request()->is('mahasiswa/kelas*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/></svg>
                        <span>Kelas Saya</span>
                    </a>
                    <a href="{{ route('mahasiswa.tugas') }}" class="nav-link {{ request()->is('mahasiswa/tugas*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v6h16V5a2 2 0 00-2-2H5z"/><path fill-rule="evenodd" d="M3 11v6a2 2 0 002 2h10a2 2 0 002-2v-6H3z"/></svg>
                        <span>Daftar Tugas</span>
                    </a>
                    <a href="{{ route('mahasiswa.curhat') }}" class="nav-link {{ request()->is('mahasiswa/curhat*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"/><path d="M6 7h8M6 11h8"/></svg>
                        <span>Curhat Vokasi</span>
                    </a>
                @endif
            </nav>

            <!-- User Profile Section -->
            <div class="border-t border-blue-800 p-4">
                <div class="bg-blue-800 bg-opacity-50 rounded-lg p-4 mb-4">
                    <p class="text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-blue-200 truncate">{{ auth()->user()->email }}</p>
                    <span class="inline-block mt-2 text-xs bg-blue-600 px-3 py-1 rounded-full capitalize">{{ auth()->user()->role }}</span>
                </div>
                
                <a href="{{ route('account.profile') }}" class="btn flex items-center justify-center space-x-2 w-full mb-2 px-4 py-2 rounded-lg bg-blue-700 hover:bg-blue-600 text-white text-sm font-medium transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM15.657 14.243a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM11 17a1 1 0 102 0v-1a1 1 0 10-2 0v1zM5.757 15.657a1 1 0 00-1.414-1.414l-.707.707a1 1 0 101.414 1.414l.707-.707zM2 10a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.757 4.343a1 1 0 00-1.414 1.414l.707.707a1 1 0 101.414-1.414l-.707-.707z"/></svg>
                    <span>Pengaturan</span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn w-full px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293-1.293z"/></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
            @endauth
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1 ml-64 overflow-y-auto">
            <!-- Header -->
            <div class="sticky top-0 bg-white shadow-md z-40">
                <div class="px-8 py-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">@yield('title', 'LMS Vokasi')</h2>
                        <p class="text-sm text-gray-500 mt-1">Selamat datang kembali!</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">{{ now()->format('l, d F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                @yield('content')

                <!-- Footer -->
                <footer class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex justify-between items-center text-gray-600 text-sm">
                        <p>&copy; 2025 LMS Vokasi. All rights reserved.</p>
                        <div class="flex space-x-6">
                            <a href="#" class="hover:text-blue-600 transition">Tentang</a>
                            <a href="#" class="hover:text-blue-600 transition">Hubungi</a>
                            <a href="#" class="hover:text-blue-600 transition">Bantuan</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script>
        // Smooth page transitions
        document.addEventListener('DOMContentLoaded', function() {
            document.body.style.opacity = '0';
            setTimeout(() => {
                document.body.style.opacity = '1';
                document.body.style.transition = 'opacity 0.3s ease';
            }, 0);
        });
    </script>
</body>
</html>
