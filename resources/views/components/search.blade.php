@include('partials.navbar')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Hasil pencarian untuk: "{{ $q }}"</h1>

    @if($brands->isEmpty())
        <div class="p-6 bg-white rounded shadow">Tidak ditemukan produk sesuai kata kunci.</div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($brands as $b)
                @include('components.brand-card', ['item' => $b])
            @endforeach
        </div>
    @endif
</div>