<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI Assistant - AAN KULI STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .assistant-input { min-height:64px }
        .assistant-card .thumb { width:72px;height:72px;border-radius:8px;overflow:hidden;background:#f8fafc;flex:0 0 72px }
        .assistant-card .thumb img { width:100%;height:100%;object-fit:cover }
        .assistant-card { transition: box-shadow .15s ease, transform .12s ease }
        .assistant-card:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(2,6,23,.08) }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-800">
    @include('partials.navbar')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <h1 class="text-2xl font-bold mb-2">AI Assistant - Rekomendasi Bahan</h1>
        <p class="text-sm text-slate-500 mb-6">Ketik pertanyaan seperti "rekomendasi bahan untuk cat tembok" atau "rekomendasi semen murah".</p>

        <div class="bg-white p-6 rounded shadow">
            <div class="flex flex-col sm:flex-row gap-3">
                <textarea id="assistant-input" placeholder="Minta rekomendasi atau ketik kata kunci... (mis. 'rekomendasi semen untuk plester dinding')" class="assistant-input flex-1 border rounded px-3 py-2"></textarea>
                <div class="flex items-start gap-2">
                    <button id="assistant-send" class="bg-[#fbbf24] text-[#0f172a] px-4 py-2 rounded font-semibold">Minta</button>
                    <button id="assistant-clear" class="border rounded px-3 py-2 text-sm text-slate-600">Bersihkan</button>
                </div>
            </div>

            <div id="assistant-status" class="mt-3 text-sm text-slate-500"></div>

            <div id="assistant-result" class="mt-6 space-y-4" aria-live="polite"></div>
        </div>
    </div>

    <script>
        const input = document.getElementById('assistant-input');
        const sendBtn = document.getElementById('assistant-send');
        const clearBtn = document.getElementById('assistant-clear');
        const status = document.getElementById('assistant-status');
        const result = document.getElementById('assistant-result');

        function setLoading(loading){
            sendBtn.disabled = loading;
            sendBtn.textContent = loading ? 'Memproses...' : 'Minta';
            status.textContent = loading ? 'Sedang mencari rekomendasi…' : '';
        }

        clearBtn.addEventListener('click', () => {
            input.value = '';
            result.innerHTML = '';
            status.textContent = '';
            input.focus();
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
                e.preventDefault();
                sendBtn.click();
            }
        });

        sendBtn.addEventListener('click', async function() {
            const prompt = input.value.trim();
            if (!prompt) return alert('Masukkan pertanyaan.');

            setLoading(true);
            result.innerHTML = '';

            try {
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
                    throw new Error(err?.error || 'Terjadi kesalahan');
                }

                const data = await res.json();

                if (data.explanation) {
                    const expl = document.createElement('div');
                    expl.className = 'text-sm text-slate-600';
                    expl.textContent = data.explanation;
                    result.appendChild(expl);
                }

                if (data.items && data.items.length) {
                    const grid = document.createElement('div');
                    grid.className = 'grid grid-cols-1 sm:grid-cols-2 gap-4';

                    data.items.forEach(i => {
                        const a = document.createElement('a');
                        a.href = i.url || '#';
                        a.className = 'assistant-card block p-3 border rounded bg-white';

                        const inner = document.createElement('div');
                        inner.className = 'flex gap-3 items-center';

                        const thumb = document.createElement('div');
                        thumb.className = 'thumb';
                        thumb.innerHTML = i.image ? `<img src="${i.image}" alt="${(i.name||'').replace(/"/g,'')}">` : `<div class="text-2xl font-bold text-slate-300 flex items-center justify-center h-full">${(i.name||'').charAt(0)||''}</div>`;

                        const content = document.createElement('div');
                        content.className = 'flex-1';
                        content.innerHTML = `<div class="font-bold">${i.name || ''}</div>
                            <div class="text-sm text-slate-500">${i.category || ''} • Rp ${i.price || '-'}</div>
                            <div class="text-sm text-slate-500 mt-1">${(i.description || '').substring(0,140)}</div>`;

                        inner.appendChild(thumb);
                        inner.appendChild(content);
                        a.appendChild(inner);
                        grid.appendChild(a);
                    });

                    result.appendChild(grid);
                } else {
                    const none = document.createElement('div');
                    none.className = 'p-4 bg-orange-50 text-orange-800 rounded';
                    none.textContent = 'Tidak ditemukan rekomendasi.';
                    result.appendChild(none);
                }

            } catch (err) {
                alert(err.message || 'Terjadi kesalahan');
            } finally {
                setLoading(false);
            }
        });
    </script>
</body>
</html>