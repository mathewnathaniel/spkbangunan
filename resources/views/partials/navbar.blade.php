<!-- Shared navbar partial -->
<nav class="fixed w-full z-50 shadow-md" id="navbar" style="background:#0f172a;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-xl" style="background:#fbbf24;color:#0f172a;">A</div>
                <span class="text-white font-bold text-xl tracking-tight">AAN KULI <span style="color:#fbbf24">STORE</span></span>
            </div>
            <div class="hidden md:flex space-x-4 items-center">
                <form action="{{ route('search') }}" method="GET" class="flex items-center">
                    <input name="q" value="{{ request('q') }}" placeholder="Cari produk, kategori, bahan..." class="rounded-md px-3 py-2 text-sm w-64 focus:outline-none" />
                    <button type="submit" class="ml-2 bg-[#fbbf24] text-[#0f172a] px-3 py-2 rounded-md text-sm font-semibold">Cari</button>
                </form>

                <a href="{{ route('home') }}" class="text-slate-200 font-medium px-3 py-2 rounded-md transition duration-150 border-b-2 border-transparent hover:border-[#fbbf24]">Beranda</a>
                <a href="{{ route('home') }}#kategori" class="text-slate-200 font-medium px-3 py-2 rounded-md transition duration-150 border-b-2 border-transparent hover:border-[#fbbf24]">Kategori</a>
                <a href="{{ route('products') }}" class="text-slate-200 font-medium px-3 py-2 rounded-md transition duration-150 border-b-2 border-transparent hover:border-[#fbbf24]">Produk</a>
                <a href="{{ route('compare') }}" class="text-slate-200 font-medium px-3 py-2 rounded-md transition duration-150 border-b-2 border-transparent hover:border-[#fbbf24]">Perbandingan</a>
                <a href="{{ route('assistant') }}" class="text-slate-200 font-medium px-3 py-2 rounded-md transition duration-150 border-b-2 border-transparent hover:border-[#fbbf24]">AI Assistant</a>
            </div>
            <!-- Admin login removed as requested -->
        </div>
    </div>
</nav>
