<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $category->name }} - AAN KULI STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style></style>
</head>
<body class="bg-slate-50 font-sans text-slate-800">
    @include('partials.navbar')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold">Kategori: {{ $category->name }}</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($brands as $brand)
                @include('components.brand-card', ['item' => $brand])
            @empty
                <div class="col-span-full text-center text-slate-500 py-12">Belum ada produk pada kategori ini.</div>
            @endforelse
        </div>
    </div>
</body>
</html>
