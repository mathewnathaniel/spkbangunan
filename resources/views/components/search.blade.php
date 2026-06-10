<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pencarian - AAN KULI STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .product-card .product-image-container { overflow: hidden; position: relative; background-color: #f8fafc; }
        .product-card .product-image { transition: transform 0.45s ease, filter 0.45s ease, opacity 0.3s ease; will-change: transform, filter; }
        .product-card .hover-overlay { position: absolute; inset: 0; background: rgba(15,23,42,0); display:flex; align-items:flex-end; justify-content:flex-start; padding:1rem; opacity:0; transition: background .35s ease, opacity .35s ease; pointer-events:none; }
        .product-card .overlay-badge{ pointer-events:none; transform: translateY(-6px); transition: transform .25s ease; }
        .product-card:hover .product-image { transform: scale(1.05); filter: brightness(.65); }
        .product-card:hover .hover-overlay { background: rgba(15,23,42,.35); opacity:1; }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-800">
    @include('partials.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <h1 class="text-2xl font-bold mb-4">Hasil pencarian untuk: "{{ $q }}"</h1>

        @if($q === '')
            <!-- No query entered: show nothing -->
            <div class="text-sm text-slate-500">Ketik kata kunci lalu tekan Cari untuk menampilkan hasil.</div>
        @else
            @if($brands->isEmpty())
                <div class="p-6 bg-white rounded shadow">Tidak ditemukan produk sesuai kata kunci.</div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($brands as $b)
                        @include('components.brand-card', ['item' => $b])
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</body>
</html>