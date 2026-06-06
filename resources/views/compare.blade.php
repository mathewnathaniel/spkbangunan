<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Perbandingan - AAN KULI STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-800">
    @include('partials.navbar')
    <div class="max-w-6xl mx-auto px-4 py-32">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold">Perbandingan Produk</h1>
        </div>

        @foreach($categories as $category)
            <div class="mb-8 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <div class="text-sm text-slate-400">Kategori</div>
                        <div class="font-bold text-lg">{{ $category->name }}</div>
                    </div>
                    <div class="text-sm text-slate-500">{{ $category->brands->count() }} Produk</div>
                </div>
                <div class="p-6 overflow-x-auto">
                    <table class="w-full table-auto text-sm">
                        <thead>
                            <tr class="text-left text-xs text-slate-500 uppercase">
                                <th class="px-3 py-2">Brand</th>
                                <th class="px-3 py-2">Harga</th>
                                <th class="px-3 py-2">Kualitas</th>
                                <th class="px-3 py-2">Minat Pasar</th>
                                <th class="px-3 py-2">Skor SAW</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->brands as $b)
                                <tr class="border-t border-slate-100">
                                    <td class="px-3 py-3 font-medium">{{ $b->name }}</td>
                                    <td class="px-3 py-3">{{ $b->score ? number_format($b->score->harga,0,',','.') : '-' }}</td>
                                    <td class="px-3 py-3">{{ $b->score ? number_format($b->score->kualitas,2) : '-' }}</td>
                                    <td class="px-3 py-3">{{ $b->score ? number_format($b->score->minat_pasar,2) : '-' }}</td>
                                    <td class="px-3 py-3">{{ number_format($b->rankingResult?->final_score ?? 0,4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
