<a href="{{ route('brand.show', $item->id) }}" class="block hover:shadow-xl transition">
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-100">
        <div class="h-52 w-full relative product-image-container">
            @if(!empty($item->image))
                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover product-image" alt="{{ $item->name }}">
            @else
                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-6xl font-bold text-slate-300">{{ substr($item->name,0,1) }}</div>
            @endif
            <div class="hover-overlay">
                <div class="bg-white/80 text-sm px-3 py-2 rounded-full font-semibold">Lihat Selengkapnya</div>
            </div>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-bold mb-1">{{ $item->name }}</h3>
            <p class="text-sm text-slate-500 mb-2">{{ \Illuminate\Support\Str::limit($item->description ?? 'Deskripsi belum tersedia', 200) }}</p>
            <p class="text-sm text-slate-500 mb-3">Kemasan: {{ $item->satuan ?? '-' }}</p>
            <div class="grid grid-cols-3 gap-4 text-sm text-slate-700 mb-4">
                <div>
                    <div class="text-xs text-slate-400">Harga</div>
                    <div class="font-bold">{{ $item->score ? number_format($item->score->harga,0,',','.') : '-' }}</div>
                </div>
            </div>
        </div>
    </div>
</a>
