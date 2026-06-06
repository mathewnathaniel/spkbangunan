<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Produk - AAN KULI STORE</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style> .badge{background:#0f172a;color:#fff;padding:4px 8px;border-radius:999px;font-size:12px} </style>
</head>
<body class="bg-slate-50 font-sans text-slate-800">
  @include('partials.navbar')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-extrabold">Semua Produk</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      <!-- Sidebar filters -->
      <aside class="lg:col-span-3 bg-white rounded-xl p-6 border border-slate-100">
        <form method="GET" action="{{ route('products') }}">
          <div class="mb-4">
            <label class="block text-sm font-medium text-slate-600 mb-2">Kategori</label>
            <select name="category_id" class="w-full rounded-md border px-3 py-2 text-sm" onchange="this.form.submit()">
              <option value="">Semua Kategori</option>
              @foreach($categories as $c)
                <option value="{{ $c->id }}" {{ (string)($categoryId ?? '') === (string)$c->id ? 'selected' : '' }}>{{ $c->name }} ({{ $c->brands_count }})</option>
              @endforeach
            </select>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-slate-600 mb-2">Brand</label>
            <select name="brand_id" class="w-full rounded-md border px-3 py-2 text-sm" onchange="this.form.submit()">
              <option value="">Semua Brand</option>
              @foreach($brandsList as $bl)
                <option value="{{ $bl->id }}" {{ (string)($brandId ?? '') === (string)$bl->id ? 'selected' : '' }}>{{ $bl->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-slate-600 mb-2">Kemasan / Satuan</label>
            <select name="satuan" class="w-full rounded-md border px-3 py-2 text-sm" onchange="this.form.submit()">
              <option value="">Semua</option>
              @foreach($satuanList as $s)
                <option value="{{ $s }}" {{ ($satuan ?? '') === $s ? 'selected' : '' }}>{{ $s }}</option>
              @endforeach
            </select>
          </div>

          <div class="flex items-center gap-2 mt-6">
            <a href="{{ route('products') }}" class="text-sm text-slate-500">Reset</a>
          </div>
        </form>
      </aside>

      <!-- Products grid -->
      <main class="lg:col-span-9">
        <div class="flex items-center justify-between mb-6">
          <div class="text-sm text-slate-500">Menampilkan {{ $brands->count() }} produk</div>
          <form method="GET" action="{{ route('products') }}" id="sortForm">
            <input type="hidden" name="category_id" value="{{ $categoryId ?? '' }}">
            <input type="hidden" name="brand_id" value="{{ $brandId ?? '' }}">
            <input type="hidden" name="satuan" value="{{ $satuan ?? '' }}">
            <select name="sort" onchange="document.getElementById('sortForm').submit()" class="rounded-md border px-3 py-2 text-sm">
              <option value="">Urutkan: Default</option>
              <option value="best" {{ ($sort ?? '') === 'best' ? 'selected' : '' }}>Best Match (Skor)</option>
              <option value="price_asc" {{ ($sort ?? '') === 'price_asc' ? 'selected' : '' }}>Price low to high</option>
              <option value="price_desc" {{ ($sort ?? '') === 'price_desc' ? 'selected' : '' }}>Price high to low</option>
            </select>
          </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @forelse($brands as $b)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-100">
              <div class="h-44 w-full bg-slate-100 flex items-center justify-center">
                @if($b->image)
                  <img src="{{ asset('storage/' . $b->image) }}" alt="{{ $b->name }}" class="h-full w-full object-cover">
                @else
                  <div class="text-6xl font-bold text-slate-300">{{ substr($b->name,0,1) }}</div>
                @endif
              </div>
              <div class="p-5">
                <div class="flex justify-between items-start">
                  <div>
                    <div class="text-xs text-slate-400">Kategori</div>
                    <div class="font-bold text-lg">{{ $b->category?->name ?? '-' }}</div>
                  </div>
                  <div class="text-right">
                    <div class="text-xs text-slate-400">Skor SAW</div>
                    <div class="font-extrabold">{{ number_format($b->rankingResult?->final_score ?? 0,4) }}</div>
                  </div>
                </div>
                <p class="text-slate-500 mt-3 font-semibold">{{ $b->name }}</p>
                <p class="text-slate-500 text-sm mt-2">{{ \Illuminate\Support\Str::limit($b->description ?? 'Deskripsi belum tersedia', 150) }}</p>
                <div class="mt-4 flex items-center justify-between">
                  <div class="text-sm text-slate-600">Kemasan: {{ $b->satuan ?? '-' }}</div>
                  <a href="{{ route('category.show', $b->category?->id ?? 0) }}" class="text-accent font-semibold">Lihat Kategori</a>
                </div>
                <div class="mt-2 text-sm text-slate-700">Harga: {{ $b->score ? number_format($b->score->harga,0,',','.') : '-' }}</div>
              </div>
            </div>
          @empty
            <div class="col-span-full text-center py-12 text-slate-500">Belum ada produk.</div>
          @endforelse
        </div>
      </main>
    </div>
  </div>
</body>
</html>
