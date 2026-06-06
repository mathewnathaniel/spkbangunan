<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $category->name }} - AAN KULI STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-800">
    @include('partials.navbar')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold">Kategori: {{ $category->name }}</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($brands as $brand)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-100">
                    <div class="h-52 w-full relative">
                        @if(!empty($brand->image))
                            <img src="{{ asset('storage/' . $brand->image) }}" class="w-full h-full object-cover" alt="{{ $brand->name }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-100 text-6xl font-bold text-slate-300">{{ substr($brand->name,0,1) }}</div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-1">{{ $brand->name }}</h3>
                            <p class="text-sm text-slate-500 mb-2">{{ \Illuminate\Support\Str::limit($brand->description ?? 'Deskripsi belum tersedia', 200) }}</p>
                            <p class="text-sm text-slate-500 mb-3">Kemasan: {{ $brand->satuan ?? '-' }}</p>
                        <div class="grid grid-cols-3 gap-4 text-sm text-slate-700 mb-4">
                            <div>
                                <div class="text-xs text-slate-400">Harga</div>
                                <div class="font-bold">{{ $brand->score ? number_format($brand->score->harga,0,',','.') : '-' }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-slate-400">Kualitas</div>
                                <div class="font-bold">{{ $brand->score ? number_format($brand->score->kualitas,2) : '-' }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-slate-400">Minat Pasar</div>
                                <div class="font-bold">{{ $brand->score ? number_format($brand->score->minat_pasar,2) : '-' }}</div>
                            </div>
                        </div>
                        <p class="text-sm text-slate-500 mb-4">Skor SAW: <span class="font-extrabold">{{ number_format($brand->rankingResult->final_score ?? 0,4) }}</span></p>
                        <!-- back button removed per request -->
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-slate-500 py-12">Belum ada produk pada kategori ini.</div>
            @endforelse
        </div>
    </div>
</body>
</html>
