<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $brand->name }} — Detail Produk</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    @include('partials.navbar')

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 md:pt-28 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow overflow-hidden border border-slate-100">
                    @if(!empty($brand->image))
                        <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 flex items-center justify-center bg-slate-100 text-8xl font-bold text-slate-300">{{ substr($brand->name,0,1) }}</div>
                    @endif
                    <div class="p-6">
                        <h1 class="text-3xl font-extrabold mb-2">{{ $brand->name }}</h1>
                        <div class="text-sm text-slate-500 mb-4">Kategori: {{ $brand->category?->name ?? '-' }}</div>
                        <p class="text-slate-700 leading-relaxed">{{ $brand->description ?? 'Deskripsi belum tersedia.' }}</p>
                    </div>
                </div>
            </div>

            <aside class="bg-white rounded-2xl shadow p-6 border border-slate-100">
                <div class="mb-4">
                    <div class="text-xs text-slate-400">Kemasan</div>
                    <div class="font-bold">{{ $brand->satuan ?? '-' }}</div>
                </div>

                <div class="mb-4">
                    <div class="text-xs text-slate-400">Harga (estimasi)</div>
                    <div class="font-bold text-2xl">{{ $brand->score ? number_format($brand->score->harga,0,',','.') : '-' }}</div>
                </div>

                <div class="mb-4">
                    <div class="text-xs text-slate-400">Kualitas</div>
                    <div class="font-bold">{{ $brand->score ? number_format($brand->score->kualitas ?? 0,2) : '-' }}</div>
                </div>

                <div class="mb-4">
                    <div class="text-xs text-slate-400">Minat Pasar</div>
                    <div class="font-bold">{{ $brand->score ? number_format($brand->score->minat_pasar ?? 0,2) : '-' }}</div>
                </div>

                <!-- <div class="mb-4">
                    <div class="text-xs text-slate-400">Skor SAW</div>
                    <div class="font-bold">{{ number_format($brand->rankingResult?->final_score ?? 0,4) }}</div>
                </div> -->

                <div class="mt-6 space-y-3">
                    <a href="{{ route('compare', ['category_id' => $brand->category_id, 'b1' => $brand->id]) }}" class="inline-block w-full text-center bg-navy-900 text-white hover:bg-navy-800 font-bold px-4 py-3 rounded-full transition shadow-md">Bandingkan Produk Ini</a>
                    <a href="javascript:history.back()" class="inline-block w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-4 py-3 rounded-full transition border border-slate-200">Kembali</a>
                </div>
            </aside>
        </div>
    </main>

</body>
</html>
