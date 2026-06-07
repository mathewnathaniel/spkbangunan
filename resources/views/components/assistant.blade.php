@include('partials.navbar')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-2xl font-bold mb-4">AI Assistant - Rekomendasi Bahan</h1>
    <p class="text-sm text-slate-500 mb-6">Ketik pertanyaan seperti "rekomendasi bahan untuk cat tembok" atau "rekomendasi semen murah".</p>

    <div class="bg-white p-6 rounded shadow">
        <div class="flex gap-3">
            <input id="assistant-input" placeholder="Minta rekomendasi atau ketik kata kunci..." class="flex-1 border rounded px-3 py-2" />
            <button id="assistant-send" class="bg-[#fbbf24] text-[#0f172a] px-4 py-2 rounded font-semibold">Minta</button>
        </div>

        <div id="assistant-result" class="mt-6"></div>
    </div>
</div>

<script>
    document.getElementById('assistant-send').addEventListener('click', async function() {
        const prompt = document.getElementById('assistant-input').value.trim();
        if (!prompt) return alert('Masukkan pertanyaan.');

        const res = await fetch("{{ route('assistant.recommend') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({ prompt })
        });

        if (!res.ok) {
            const err = await res.json().catch(() => ({}));
            return alert(err?.error || 'Terjadi kesalahan');
        }

        const data = await res.json();
        const container = document.getElementById('assistant-result');
        container.innerHTML = '';

        const expl = document.createElement('div');
        expl.className = 'mb-4 text-sm text-slate-500';
        expl.textContent = data.explanation || '';
        container.appendChild(expl);

        if (data.items && data.items.length) {
            const grid = document.createElement('div');
            grid.className = 'grid grid-cols-1 sm:grid-cols-2 gap-4';

            data.items.forEach(i => {
                const card = document.createElement('a');
                card.href = i.url;
                card.className = 'block p-3 border rounded hover:shadow';
                card.innerHTML = `
                    <div class="flex gap-3 items-center">
                        <div style="width:72px;height:72px;flex:0 0 72px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;overflow:hidden;border-radius:8px;">
                            ${i.image ? `<img src="${i.image}" style="width:100%;height:100%;object-fit:cover" />` : '<div class="text-2xl font-bold text-slate-300">' + (i.name.charAt(0) || '') + '</div>'}
                        </div>
                        <div class="flex-1">
                            <div class="font-bold">${i.name}</div>
                            <div class="text-sm text-slate-500">${i.category || ''} • Rp ${i.price || '-'}</div>
                            <div class="text-sm text-slate-500 mt-1">${(i.description || '').substring(0,120)}</div>
                        </div>
                    </div>
                `;
                grid.appendChild(card);
            });

            container.appendChild(grid);
        } else {
            container.appendChild(document.createElement('div')).textContent = 'Tidak ditemukan rekomendasi.';
        }
    });
</script>