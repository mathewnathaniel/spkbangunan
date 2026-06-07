<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAN KULI STORE - Material Premium</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        navy: {
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                        accent: {
                            DEFAULT: '#fbbf24', // Amber/Yellow accent
                            hover: '#f59e0b',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Custom Hover Effect for Featured Products */
        .product-card .product-image-container {
            overflow: hidden;
            position: relative;
            background-color: #f8fafc;
        }
        .product-card .product-image {
            transition: all 0.5s ease-in-out;
        }
        .product-card .hover-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.4s ease;
        }
        .product-card:hover .product-image {
            transform: scale(0.9);
            opacity: 0.5;
        }
        .product-card:hover .hover-overlay {
            background: rgba(15, 23, 42, 0.5);
            opacity: 1;
        }

        /* Comparison CTA Button Hover Popup Effect */
        .cta-btn-wrapper {
            position: relative;
            display: inline-block;
        }
        .cta-btn-popup {
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%) scale(0.8);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            pointer-events: none;
            white-space: nowrap;
        }
        .cta-btn-wrapper:hover .cta-btn-popup {
            top: -50px;
            transform: translateX(-50%) scale(1);
            opacity: 1;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased overflow-x-hidden">

    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-navy-900 overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] rounded-full bg-accent/20 blur-[120px]"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[600px] h-[600px] rounded-full bg-blue-500/20 blur-[120px]"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAwIDEwIEwgNDAgMTAgTSAxMCAwIEwgMTAgNDAiIGZpbGw9Im5vbmUiIHN0cm9rZT0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjA1KSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')] opacity-50"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="hero-content">
                    <div class="inline-block px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-accent font-medium text-sm mb-6 backdrop-blur-md">
                        Pilihan Utama Kontraktor & Pemborong
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-white leading-[1.1] tracking-tight mb-6">
                        Solusi Material <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-orange-500">Premium</span> Bangunan.
                    </h1>
                    <p class="text-lg text-slate-300 mb-8 max-w-lg leading-relaxed">
                        Temukan kualitas terbaik untuk semen, pasir, dan cat dengan dukungan sistem pendukung keputusan cerdas kami.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#kategori" class="bg-accent hover:bg-accent-hover text-navy-900 px-8 py-4 rounded-full font-bold text-lg transition shadow-[0_0_20px_rgba(251,191,36,0.3)] hover:shadow-[0_0_30px_rgba(251,191,36,0.5)] transform hover:-translate-y-1">
                            JELAJAHI KATALOG
                        </a>
                        <a href="{{ route('compare') }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-8 py-4 rounded-full font-bold text-lg transition backdrop-blur-sm">
                            Mulai Perbandingan
                        </a>
                    </div>
                </div>

                <div class="relative hero-image-container flex justify-center lg:justify-end">
                    <!-- Placeholder for 3D Building Tools -->
                    <div class="relative w-full max-w-md aspect-square rounded-2xl bg-gradient-to-br from-slate-800 to-navy-900 border border-white/10 shadow-2xl overflow-hidden flex items-center justify-center p-8 backdrop-blur-xl">
                        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent"></div>
                        <div class="relative z-10 w-full h-full flex flex-col items-center justify-center gap-6">
                            <div class="flex gap-4 items-end">
                                <div class="w-24 h-32 bg-slate-200 rounded-lg shadow-xl border-b-4 border-slate-300 transform -rotate-12 translate-y-4">
                                    <div class="h-1/3 bg-slate-300 rounded-t-lg opacity-50"></div>
                                    <div class="text-center mt-4 font-bold text-slate-400 text-xs uppercase">Semen</div>
                                </div>
                                <div class="w-20 h-28 bg-blue-100 rounded-lg shadow-xl border-b-4 border-blue-200 z-10">
                                    <div class="h-full w-full rounded-lg bg-gradient-to-t from-blue-200 to-white flex items-center justify-center">
                                        <div class="w-12 h-4 bg-white rounded-full opacity-50"></div>
                                    </div>
                                </div>
                                <div class="w-32 h-16 bg-amber-100/80 rounded-t-full shadow-xl border-b-4 border-amber-200 transform translate-y-4 translate-x-[-10px] z-0"></div>
                            </div>
                            <div class="absolute top-10 right-4 bg-white/90 backdrop-blur-sm px-3 py-2 rounded-xl shadow-lg border border-white/50 flex items-center gap-2 transform rotate-3">
                                <div class="text-accent">★</div>
                                <div class="font-bold text-navy-900 text-sm">4.9/5 Rating</div>
                            </div>
                            <div class="absolute bottom-12 left-4 bg-navy-800/90 backdrop-blur-sm px-4 py-3 rounded-xl shadow-lg border border-white/10 flex items-center gap-3 transform -rotate-6">
                                <div class="w-8 h-8 rounded-full bg-accent flex items-center justify-center text-navy-900 font-bold">✓</div>
                                <div>
                                    <div class="text-xs text-slate-400 uppercase tracking-wider">Kualitas</div>
                                    <div class="font-bold text-white text-sm">Terjamin 100%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Carousel Section -->
    <section id="kategori" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 category-header">
                <h2 class="text-accent font-bold tracking-wider uppercase text-sm mb-2">Kategori Utama</h2>
                <h3 class="text-4xl font-extrabold text-navy-900">Pilih Material Kebutuhan Anda</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 category-items">
                @forelse($categories as $category)
                    <div class="group cursor-pointer rounded-2xl bg-slate-50 border border-slate-100 p-8 text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:border-accent/30 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-accent to-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                        <div class="w-20 h-20 mx-auto bg-navy-900 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            @if(strtolower($category->name) == 'semen')
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            @elseif(strtolower($category->name) == 'cat')
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                            @else
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            @endif
                        </div>
                        <h4 class="text-2xl font-bold text-navy-900 mb-2">{{ $category->name }}</h4>
                        <p class="text-slate-500 mb-6">{{ $category->brands->count() }} Produk Tersedia</p>
                        <a href="{{ route('category.show', $category->id) }}" class="inline-flex items-center text-accent font-semibold group-hover:text-accent-hover">
                            Lihat Produk
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                @empty
                    @foreach(['Semen', 'Pasir', 'Cat'] as $catName)
                    <div class="group cursor-pointer rounded-2xl bg-slate-50 border border-slate-100 p-8 text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:border-accent/30 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-accent to-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                        <div class="w-20 h-20 mx-auto bg-navy-900 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h4 class="text-2xl font-bold text-navy-900 mb-2">{{ $catName }}</h4>
                        <p class="text-slate-500 mb-6">Banyak Produk Tersedia</p>
                    </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="produk" class="py-24 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 products-header">
                <div>
                    <h2 class="text-accent font-bold tracking-wider uppercase text-sm mb-2">Rekomendasi Terbaik</h2>
                    <h3 class="text-4xl font-extrabold text-navy-900">Material Unggulan</h3>
                </div>
                <a href="#kategori" class="hidden md:inline-flex items-center text-navy-900 font-semibold hover:text-accent transition mt-4 md:mt-0">
                    Lihat Semua Produk
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredProducts as $product)
                    @include('components.brand-card', ['item' => $product])
                @empty
                    <div class="col-span-full text-center py-12 text-slate-500">
                        Belum ada produk yang tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Comparison CTA Section -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-navy-900"></div>
        <div class="absolute right-0 top-0 w-1/2 h-full bg-gradient-to-l from-accent/20 to-transparent"></div>
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-accent rounded-full opacity-10 blur-3xl"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center cta-content">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">Bingung Pilih Material?</h2>
            <p class="text-lg text-slate-300 mb-10 max-w-2xl mx-auto">
                Gunakan fitur perbandingan cerdas kami yang ditenagai oleh metode AHP dan SAW untuk menemukan material terbaik sesuai kriteria Anda.
            </p>
            <div class="cta-btn-wrapper inline-block">
                <div class="cta-btn-popup bg-white text-navy-900 px-4 py-2 rounded-lg font-bold text-sm shadow-xl flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Fitur AHP & SAW Aktif
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[8px] border-l-transparent border-r-transparent border-t-white"></div>
                </div>
                <a href="{{ route('compare') }}" class="bg-accent hover:bg-white text-navy-900 px-10 py-5 rounded-full font-extrabold text-lg transition-all duration-300 shadow-[0_0_30px_rgba(251,191,36,0.3)] inline-flex items-center gap-3 border-2 border-accent">
                    MULAI PERBANDINGAN SEKARANG
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-navy-800 text-slate-300 py-12 border-t border-navy-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded bg-accent flex items-center justify-center font-bold text-navy-900">A</div>
                        <span class="text-white font-bold text-xl tracking-tight">AAN KULI STORE</span>
                    </div>
                    <p class="text-sm text-slate-400 max-w-sm">
                        Sistem Pendukung Keputusan Pemilihan Material Bangunan menggunakan metode AHP dan SAW. Solusi cerdas untuk kontraktor modern.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Navigasi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-accent transition">Beranda</a></li>
                        <li><a href="#kategori" class="hover:text-accent transition">Kategori</a></li>
                        <li><a href="#produk" class="hover:text-accent transition">Produk</a></li>
                        <li><a href="{{ route('compare') }}" class="hover:text-accent transition">Perbandingan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Kontak</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li>Jl. Material No. 123</li>
                        <li>Jakarta, Indonesia</li>
                        <li>info@aankulistore.com</li>
                        <li>+62 812 3456 7890</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-700/50 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p>&copy; {{ date('Y') }} AAN KULI STORE. All rights reserved.</p>
                <div class="mt-4 md:mt-0 flex gap-4">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts (GSAP & Motion) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script type="module">
        import { animate, scroll, inView, stagger } from "https://cdn.jsdelivr.net/npm/motion@11.11.13/+esm"

        gsap.registerPlugin(ScrollTrigger);

        document.addEventListener("DOMContentLoaded", (event) => {
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('shadow-lg');
                } else {
                    navbar.classList.remove('shadow-lg');
                }
            });
        });
    </script>
</body>
</html>
