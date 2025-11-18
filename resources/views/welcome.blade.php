<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Vokasi - Learning Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .animate-slideInLeft {
            animation: slideInLeft 0.8s ease-out forwards;
        }
        .animate-slideInRight {
            animation: slideInRight 0.8s ease-out forwards;
        }
        .bg-gradient-animate {
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-lg shadow-lg z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-xl md:text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">LMS Vokasi</span>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="/" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-gray-700 hover:text-blue-600 font-semibold transition duration-300">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 space-y-3">
                @auth
                    <a href="/" class="block px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg text-center">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block px-6 py-2.5 text-gray-700 hover:bg-gray-100 rounded-xl font-semibold text-center transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="block px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg text-center">
                        Daftar Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 md:pt-40 pb-20 px-6">
        <div class="container mx-auto max-w-7xl">
            <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-center">
                <!-- Left Content -->
                <div class="space-y-6 order-2 md:order-1">
                    <div class="inline-block px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full">
                        <span class="text-sm font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">🎓 Platform Pembelajaran Modern</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Belajar Lebih Mudah dengan
                        <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">LMS Vokasi</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
                        Platform Learning Management System terpadu untuk mahasiswa, dosen, dan administrator. Akses materi, kumpulkan tugas, dan kelola pembelajaran dalam satu tempat.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold shadow-xl hover:shadow-2xl transform hover:scale-105 transition duration-300 flex items-center justify-center space-x-2">
                            <span>Mulai Belajar</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="#features" class="px-8 py-4 bg-white text-gray-700 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300 flex items-center justify-center space-x-2">
                            <span>Pelajari Lebih Lanjut</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                    </div>
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 md:gap-6 pt-8">
                        <div class="text-center p-4 bg-white/50 rounded-xl backdrop-blur-sm">
                            <div class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">500+</div>
                            <div class="text-xs md:text-sm text-gray-600 mt-1">Mahasiswa</div>
                        </div>
                        <div class="text-center p-4 bg-white/50 rounded-xl backdrop-blur-sm">
                            <div class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">50+</div>
                            <div class="text-xs md:text-sm text-gray-600 mt-1">Dosen</div>
                        </div>
                        <div class="text-center p-4 bg-white/50 rounded-xl backdrop-blur-sm">
                            <div class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-pink-600 to-red-600 bg-clip-text text-transparent">100+</div>
                            <div class="text-xs md:text-sm text-gray-600 mt-1">Mata Kuliah</div>
                        </div>
                    </div>
                </div>

                <!-- Right Illustration -->
                <div class="relative order-1 md:order-2 mb-8 md:mb-0">
                    <div class="relative z-10 max-w-md mx-auto">
                        <!-- Main Card -->
                        <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8 space-y-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-blue-400 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0">
                                    <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs md:text-sm text-gray-500">Tugas Terbaru</div>
                                    <div class="text-sm md:text-base font-semibold text-gray-900">Algoritma & Pemrograman</div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Progress</span>
                                    <span class="font-semibold text-blue-600">75%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-3 rounded-full transition-all duration-500" style="width: 75%"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-4">
                                <span class="text-xs md:text-sm text-gray-500">Deadline: 3 hari lagi</span>
                                <button class="px-3 py-2 md:px-4 md:py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg text-xs md:text-sm font-semibold hover:shadow-lg transition duration-300">
                                    Kerjakan
                                </button>
                            </div>
                        </div>
                        
                        <!-- Floating Cards -->
                        <div class="absolute -top-4 -right-4 bg-gradient-to-br from-pink-500 to-red-500 text-white rounded-xl md:rounded-2xl p-3 md:p-4 shadow-xl z-20 animate-float">
                            <div class="text-xl md:text-2xl font-bold">A</div>
                            <div class="text-xs">Nilai</div>
                        </div>
                        <div class="absolute -bottom-4 -left-4 bg-gradient-to-br from-green-500 to-teal-500 text-white rounded-xl md:rounded-2xl p-3 md:p-4 shadow-xl z-20" style="animation: float 3s ease-in-out infinite 1s;">
                            <div class="text-xl md:text-2xl font-bold">12</div>
                            <div class="text-xs">Kelas</div>
                        </div>
                    </div>
                    
                    <!-- Background Decorations -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 md:w-96 md:h-96 bg-gradient-to-br from-blue-200/20 to-purple-200/20 rounded-full blur-3xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 md:py-20 px-6 bg-white/50 backdrop-blur-sm">
        <div class="container mx-auto max-w-7xl">
            <div class="text-center mb-12 md:mb-16">
                <div class="inline-block px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full mb-4">
                    <span class="text-sm font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">✨ Fitur Unggulan</span>
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Semua yang Anda Butuhkan
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                    Platform lengkap dengan fitur-fitur modern untuk mendukung pembelajaran yang efektif
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-white rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-2xl">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4">Manajemen Kelas</h3>
                    <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6">Kelola kelas, mahasiswa, dan materi pembelajaran dengan mudah dalam satu dashboard terpadu.</p>
                    <div class="flex items-center text-blue-600 font-semibold text-sm">
                        <span>Selengkapnya</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-white rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-2xl">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4">Pengumpulan Tugas</h3>
                    <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6">Submit tugas secara online, tracking deadline, dan terima feedback langsung dari dosen.</p>
                    <div class="flex items-center text-purple-600 font-semibold text-sm">
                        <span>Selengkapnya</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-white rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-2xl">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4">Curhat Vokasi</h3>
                    <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6">Forum diskusi dan konseling untuk berbagi pengalaman serta mendapat bimbingan dari dosen.</p>
                    <div class="flex items-center text-pink-600 font-semibold text-sm">
                        <span>Selengkapnya</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card bg-white rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-2xl">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4">Penilaian & Nilai</h3>
                    <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6">Sistem penilaian transparan dengan tracking progress dan laporan nilai real-time.</p>
                    <div class="flex items-center text-green-600 font-semibold text-sm">
                        <span>Selengkapnya</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card bg-white rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-2xl">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4">Jadwal Kuliah</h3>
                    <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6">Akses jadwal kuliah, reminder otomatis, dan notifikasi perubahan jadwal.</p>
                    <div class="flex items-center text-yellow-600 font-semibold text-sm">
                        <span>Selengkapnya</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card bg-white rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-2xl">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 md:mb-6 shadow-lg">
                        <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4">Multi User Role</h3>
                    <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6">Akses berbeda untuk admin, dosen, dan mahasiswa dengan dashboard khusus masing-masing.</p>
                    <div class="flex items-center text-indigo-600 font-semibold text-sm">
                        <span>Selengkapnya</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-6">
        <div class="container mx-auto">
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-3xl p-12 md:p-16 shadow-2xl bg-gradient-animate">
                <div class="text-center text-white space-y-6 max-w-3xl mx-auto">
                    <h2 class="text-4xl md:text-5xl font-bold">Siap Memulai Perjalanan Belajar?</h2>
                    <p class="text-xl text-white/90">Bergabunglah dengan ribuan mahasiswa yang sudah merasakan kemudahan belajar dengan LMS Vokasi</p>
                    <div class="flex flex-wrap gap-4 justify-center pt-6">
                        <a href="{{ route('register') }}" class="px-10 py-4 bg-white text-blue-600 rounded-xl font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition duration-300 flex items-center space-x-2">
                            <span>Daftar Gratis Sekarang</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="px-10 py-4 bg-white/20 backdrop-blur-lg text-white rounded-xl font-bold border-2 border-white hover:bg-white/30 transform hover:scale-105 transition duration-300">
                            Sudah Punya Akun? Masuk
                        </a>
                    </div>
                    <div class="flex items-center justify-center space-x-8 pt-8 text-sm text-white/80">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Gratis</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Mudah Digunakan</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>24/7 Akses</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-6">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">LMS Vokasi</span>
                    </div>
                    <p class="text-gray-400">Platform pembelajaran terpadu untuk pendidikan vokasi modern.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Fitur</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Manajemen Kelas</a></li>
                        <li><a href="#" class="hover:text-white transition">Pengumpulan Tugas</a></li>
                        <li><a href="#" class="hover:text-white transition">Curhat Vokasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Penilaian</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Tentang</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Bantuan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Legal</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Privasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white transition">Kebijakan Cookie</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2025 LMS Vokasi. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    if (mobileMenu) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        });

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                }
            });
        }, observerOptions);

        // Observe all feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>
