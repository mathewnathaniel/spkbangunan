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
=======
    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="absolute inset-0 bg-navy-900/90 backdrop-blur-md"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-2">
                    <!-- Logo Icon Placeholder -->
                    <div class="w-10 h-10 rounded-lg bg-accent flex items-center justify-center font-bold text-navy-900 text-xl">
                        A
                    </div>
                    <span class="text-white font-bold text-xl tracking-tight">AAN KULI <span class="text-accent">STORE</span></span>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="text-slate-300 hover:text-white transition font-medium">Beranda</a>
                    <a href="#kategori" class="text-slate-300 hover:text-white transition font-medium">Kategori</a>
                    <a href="#produk" class="text-slate-300 hover:text-white transition font-medium">Produk</a>
                    <a href="{{ route('compare') }}" class="text-slate-300 hover:text-accent transition font-medium border-b-2 border-transparent hover:border-accent pb-1">Perbandingan</a>
                </div>
                
                <!-- <div class="hidden md:flex items-center">
                    <a href="/admin/login" class="bg-white/10 hover:bg-white/20 text-white px-5 py-2.5 rounded-full font-medium transition backdrop-blur-sm border border-white/10">
                        Admin Login
                    </a>
                </div> -->
            </div>
        </div>
    </nav>
>>>>>>> 64bf85ad1cca3aebf835e59802500cf398c23371

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-navy-900 overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] rounded-full bg-accent/20 blur-[120px]"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[600px] h-[600px] rounded-full bg-blue-500/20 blur-[120px]"></div>
            
            <!-- Grid Pattern -->
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
                        <!-- Simulated 3D elements using CSS -->
                        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent"></div>
                        
                        <div class="relative z-10 w-full h-full flex flex-col items-center justify-center gap-6">
                            <div class="flex gap-4 items-end">
                                <!-- Box 1 (Semen) -->
                                <div class="w-24 h-32 bg-slate-200 rounded-lg shadow-xl border-b-4 border-slate-300 transform -rotate-12 translate-y-4">
                                    <div class="h-1/3 bg-slate-300 rounded-t-lg opacity-50"></div>
                                    <div class="text-center mt-4 font-bold text-slate-400 text-xs uppercase">Semen</div>
                                </div>
                                <!-- Box 2 (Cat) -->
                                <div class="w-20 h-28 bg-blue-100 rounded-lg shadow-xl border-b-4 border-blue-200 z-10">
                                    <div class="h-full w-full rounded-lg bg-gradient-to-t from-blue-200 to-white flex items-center justify-center">
                                        <div class="w-12 h-4 bg-white rounded-full opacity-50"></div>
                                    </div>
                                </div>
                                <!-- Box 3 (Pasir) -->
                                <div class="w-32 h-16 bg-amber-100/80 rounded-t-full shadow-xl border-b-4 border-amber-200 transform translate-y-4 translate-x-[-10px] z-0"></div>
                            </div>
                            
                            <!-- Floating badges -->
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

            <!-- Categories Grid (acting as carousel for now) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 category-items">
                @forelse($categories as $category)
                    <div class="group cursor-pointer rounded-2xl bg-slate-50 border border-slate-100 p-8 text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:border-accent/30 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-accent to-orange-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                        
                        <div class="w-20 h-20 mx-auto bg-navy-900 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <!-- Icon logic based on category name -->
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
                    <!-- Fallback Categories -->
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
                    <div class="product-card bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <div class="product-image-container h-60 w-full relative">
                            @if(!empty($product->image))
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover rounded-t-2xl" />
                            @else
                                <div class="product-image absolute inset-0 w-full h-full object-cover rounded-t-2xl flex items-center justify-center text-6xl font-black text-slate-200" 
                                    style="background-color: {{ ['#f1f5f9', '#f0fdf4', '#fef3c7', '#eff6ff'][crc32($product->name) % 4] }}">
                                    {{ substr($product->name, 0, 1) }}
                                </div>
                            @endif
                            
                            <!-- Hover Overlay -->
                            <div class="hover-overlay z-10">
                                <span class="bg-white text-navy-900 font-bold px-6 py-3 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 shadow-xl">
                                    Lihat Detail
                                </span>
                            </div>
                            
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4 z-20">
                                <span class="bg-navy-900/80 backdrop-blur-sm text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                                    {{ $product->category->name ?? 'Material' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="text-xl font-bold text-navy-900 line-clamp-1">{{ $product->name }}</h4>
                                <p class="text-slate-500 text-sm mt-2">{{ \Illuminate\Support\Str::limit($product->description ?? 'Deskripsi belum tersedia', 120) }}</p>
                                    <div class="flex items-center text-accent">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="text-sm font-bold ml-1 text-slate-700">5.0</span>
                                </div>
                            </div>
                            <p class="text-slate-500 text-sm mb-2">Kemasan: {{ $product->satuan ?? '-' }}</p>
                            <p class="text-slate-500 text-sm mb-2">Harga: {{ $product->score ? number_format($product->score->harga,0,',','.') : '-' }}</p>
                            <p class="text-slate-500 text-sm mb-4">Kualitas: {{ $product->score ? number_format($product->score->kualitas,2) : '-' }} • Minat Pasar: {{ $product->score ? number_format($product->score->minat_pasar,2) : '-' }}</p>
                            
                            <div class="flex items-center justify-between mt-6 pt-6 border-t border-slate-100">
                                <div>
                                    <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold mb-1">Skor SAW</p>
                                    <p class="text-lg font-extrabold text-navy-900">{{ number_format($product->rankingResult->final_score ?? 0, 4) }}</p>
                                </div>
                                <button class="w-10 h-10 rounded-full bg-slate-100 text-navy-900 flex items-center justify-center hover:bg-accent hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
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
        <!-- Background Banner -->
        <div class="absolute inset-0 bg-navy-900"></div>
        <div class="absolute right-0 top-0 w-1/2 h-full bg-gradient-to-l from-accent/20 to-transparent"></div>
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-accent rounded-full opacity-10 blur-3xl"></div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center cta-content">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">Bingung Pilih Material?</h2>
            <p class="text-lg text-slate-300 mb-10 max-w-2xl mx-auto">
                Gunakan fitur perbandingan cerdas kami yang ditenagai oleh metode AHP dan SAW untuk menemukan material terbaik sesuai kriteria Anda.
            </p>
            
            <div class="cta-btn-wrapper inline-block">
                <!-- Tooltip Popup -->
                <div class="cta-btn-popup bg-white text-navy-900 px-4 py-2 rounded-lg font-bold text-sm shadow-xl flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Fitur AHP & SAW Aktif
                    <!-- Arrow down -->
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

        // Register GSAP ScrollTrigger
        gsap.registerPlugin(ScrollTrigger);

        document.addEventListener("DOMContentLoaded", (event) => {
            // Navbar Background Change on Scroll
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('shadow-lg');
                } else {
                    navbar.classList.remove('shadow-lg');
                }
            });

            // GSAP Animations
            
            // Hero Section Animation
            gsap.fromTo(".hero-content h1", 
                { opacity: 0, y: 50 }, 
                { opacity: 1, y: 0, duration: 1, ease: "power3.out", delay: 0.2 }
            );
            gsap.fromTo(".hero-content p", 
                { opacity: 0, y: 30 }, 
                { opacity: 1, y: 0, duration: 1, ease: "power3.out", delay: 0.4 }
            );
            gsap.fromTo(".hero-content div, .hero-content a", 
                { opacity: 0, y: 20 }, 
                { opacity: 1, y: 0, duration: 0.8, ease: "power3.out", stagger: 0.1, delay: 0.5 }
            );
            
            // Hero Image 3D Elements Float Animation
            gsap.to(".hero-image-container .w-24", {
                y: "-=15",
                rotation: "-=5",
                duration: 3,
                yoyo: true,
                repeat: -1,
                ease: "sine.inOut"
            });
            gsap.to(".hero-image-container .w-20", {
                y: "+=10",
                duration: 2.5,
                yoyo: true,
                repeat: -1,
                ease: "sine.inOut",
                delay: 0.5
            });
            gsap.to(".hero-image-container .absolute.top-10", {
                y: "-=10",
                duration: 2,
                yoyo: true,
                repeat: -1,
                ease: "sine.inOut",
                delay: 1
            });

            // Using Motion.dev for scroll animations
            // Categories
            inView(".category-header", (info) => {
                animate(info.target, { opacity: [0, 1], y: [30, 0] }, { duration: 0.8 });
            });

            inView(".category-items", (info) => {
                animate(
                    ".category-items > div",
                    { opacity: [0, 1], y: [50, 0], scale: [0.9, 1] },
                    { duration: 0.6, delay: stagger(0.15) }
                );
            });

            // Products
            inView(".products-header", (info) => {
                animate(info.target, { opacity: [0, 1], x: [-30, 0] }, { duration: 0.8 });
            });

            inView(".product-card", (info) => {
                animate(
                    info.target,
                    { opacity: [0, 1], y: [40, 0] },
                    { duration: 0.7, delay: 0.1 }
                );
            });

            // CTA Section with GSAP
            gsap.fromTo(".cta-content", 
                { opacity: 0, scale: 0.9 },
                { 
                    opacity: 1, 
                    scale: 1, 
                    duration: 1, 
                    ease: "back.out(1.2)",
                    scrollTrigger: {
                        trigger: ".cta-content",
                        start: "top 80%",
                    }
                }
            );
        });
    </script>
</body>
</html>
