<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perbandingan Produk - AAN KULI STORE</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        navy: { 800: '#1e293b', 900: '#0f172a' },
                        accent: { DEFAULT: '#fbbf24', hover: '#f59e0b' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col">
    @include('partials.navbar')

    <!-- Hero Header -->
    <div class="bg-navy-900 pt-32 pb-16 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAwIDEwIEwgNDAgMTAgTSAxMCAwIEwgMTAgNDAiIGZpbGw9Im5vbmUiIHN0cm9rZT0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjA1KSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')] opacity-30"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Perbandingan Bersebelahan</h1>
                    <p class="text-slate-300 mt-2 max-w-xl text-sm md:text-base">
                        Pilih dua produk, lalu klik <strong>Bandingkan</strong> untuk melihat hasil perbandingan kriteria SPK (AHP &amp; SAW).
                    </p>
                </div>
                <!-- Highlight toggle -->
                <div class="flex items-center gap-3 bg-white/10 px-4 py-3 rounded-2xl border border-white/10 backdrop-blur-md self-start md:self-auto">
                    <span class="text-xs md:text-sm font-semibold text-slate-200">Sorot Nilai Terbaik</span>
                    <button id="toggle-highlight" class="w-12 h-6 flex items-center bg-slate-600 rounded-full p-0.5 cursor-pointer transition-colors duration-300 focus:outline-none" aria-label="Toggle Highlight">
                        <span class="bg-white w-5 h-5 rounded-full shadow-md transform translate-x-0 transition-transform duration-300" id="toggle-dot"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">
        <!-- Category Tabs -->
        <div class="flex flex-wrap gap-2 border-b border-slate-200 pb-4 mb-8" id="category-tabs"></div>

        <!-- Comparison Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-fixed min-w-[500px]">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="w-2/5 p-6 text-left font-bold text-slate-400 text-xs uppercase tracking-wider border-b border-slate-100">Kriteria / Hasil</th>
                            <th class="w-3/10 p-6 border-l border-b border-slate-100 relative" id="slot-head-0"></th>
                            <th class="w-3/10 p-6 border-l border-b border-slate-100 relative" id="slot-head-1"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <!-- Kriteria -->
                        <tr class="bg-slate-100/40">
                            <td colspan="3" class="px-4 py-2 font-bold text-slate-500 uppercase tracking-wider text-xs">Kriteria SPK</td>
                        </tr>
                        <tr>
                            <td class="p-4 font-medium text-slate-600">Harga</td>
                            <td class="p-4 border-l border-slate-100 font-semibold text-slate-900" id="row-harga-0">-</td>
                            <td class="p-4 border-l border-slate-100 font-semibold text-slate-900" id="row-harga-1">-</td>
                        </tr>
                        <tr>
                            <td class="p-4 font-medium text-slate-600">Kualitas</td>
                            <td class="p-4 border-l border-slate-100 font-semibold text-slate-900" id="row-kualitas-0">-</td>
                            <td class="p-4 border-l border-slate-100 font-semibold text-slate-900" id="row-kualitas-1">-</td>
                        </tr>
                        <tr>
                            <td class="p-4 font-medium text-slate-600">Minat Pasar</td>
                            <td class="p-4 border-l border-slate-100 font-semibold text-slate-900" id="row-minat-0">-</td>
                            <td class="p-4 border-l border-slate-100 font-semibold text-slate-900" id="row-minat-1">-</td>
                        </tr>

                        <!-- Hasil -->
                        <tr class="bg-slate-100/40">
                            <td colspan="3" class="px-4 py-2 font-bold text-slate-500 uppercase tracking-wider text-xs">Hasil SPK</td>
                        </tr>
                        <tr>
                            <td class="p-4 font-medium text-slate-600">Skor Akhir</td>
                            <td class="p-4 border-l border-slate-100 font-bold text-navy-900" id="row-saw_score-0">-</td>
                            <td class="p-4 border-l border-slate-100 font-bold text-navy-900" id="row-saw_score-1">-</td>
                        </tr>
                        <tr>
                            <td class="p-4 font-medium text-slate-600">Peringkat</td>
                            <td class="p-4 border-l border-slate-100" id="row-rank-0">-</td>
                            <td class="p-4 border-l border-slate-100" id="row-rank-1">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Action Bar — visible only when both slots filled -->
            <div id="compare-action-bar" class="hidden border-t border-slate-100 p-6 items-center justify-center gap-4 bg-slate-50/50">
                <button onclick="runComparison()" class="bg-navy-900 hover:bg-navy-800 text-white font-bold px-10 py-3 rounded-full transition shadow-md text-sm">
                    Bandingkan Sekarang
                </button>
                <button onclick="resetComparison()" class="bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 font-semibold px-6 py-3 rounded-full transition text-sm">
                    Atur Ulang
                </button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-navy-800 text-slate-300 py-8 border-t border-navy-900/50 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            <p>&copy; {{ date('Y') }} AAN KULI STORE. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const categoriesData = @json($compareData);
    </script>

    <script>
        let activeCategoryId = null;
        let selectedBrandIds = [null, null];
        let highlightBest = false;
        let comparisonDone = false;

        document.addEventListener('DOMContentLoaded', () => {
            initializeFromUrl();
            renderCategoryTabs();
            renderCompareTable();
            setupEventListeners();
        });

        function initializeFromUrl() {
            const params = new URLSearchParams(window.location.search);
            const urlCatId = parseInt(params.get('category_id'));
            const found = categoriesData.find(c => c.id === urlCatId);
            activeCategoryId = found ? urlCatId : (categoriesData.length > 0 ? categoriesData[0].id : null);

            const b1 = parseInt(params.get('b1')) || null;
            const b2 = parseInt(params.get('b2')) || null;
            const cat = categoriesData.find(c => c.id === activeCategoryId);
            if (cat) {
                const ids = cat.brands.map(b => b.id);
                selectedBrandIds[0] = ids.includes(b1) ? b1 : null;
                selectedBrandIds[1] = ids.includes(b2) ? b2 : null;
            }
        }

        function updateUrl() {
            const params = new URLSearchParams();
            if (activeCategoryId) params.set('category_id', activeCategoryId);
            if (selectedBrandIds[0]) params.set('b1', selectedBrandIds[0]);
            if (selectedBrandIds[1]) params.set('b2', selectedBrandIds[1]);
            window.history.replaceState({}, '', window.location.pathname + '?' + params.toString());
        }

        function renderCategoryTabs() {
            const container = document.getElementById('category-tabs');
            container.innerHTML = '';
            categoriesData.forEach(cat => {
                const active = cat.id === activeCategoryId;
                const btn = document.createElement('button');
                btn.className = `px-6 py-3 rounded-full font-bold text-sm transition-all duration-200 border shadow-sm ${
                    active ? 'bg-accent text-navy-900 border-accent' : 'bg-white text-slate-600 border-slate-100 hover:border-slate-300 hover:bg-slate-50'
                }`;
                btn.innerText = cat.name;
                btn.addEventListener('click', () => changeCategory(cat.id));
                container.appendChild(btn);
            });
        }

        function changeCategory(catId) {
            activeCategoryId = catId;
            selectedBrandIds = [null, null];
            comparisonDone = false;
            renderCategoryTabs();
            renderCompareTable();
            updateUrl();
        }

        function setupEventListeners() {
            const btn = document.getElementById('toggle-highlight');
            const dot = document.getElementById('toggle-dot');
            btn.addEventListener('click', () => {
                highlightBest = !highlightBest;
                btn.classList.toggle('bg-slate-600', !highlightBest);
                btn.classList.toggle('bg-emerald-500', highlightBest);
                dot.classList.toggle('translate-x-6', highlightBest);
                applyHighlights();
            });
        }

        function updateActionBar() {
            const bar = document.getElementById('compare-action-bar');
            const both = selectedBrandIds[0] && selectedBrandIds[1];
            bar.classList.toggle('hidden', !both);
            bar.classList.toggle('flex', !!both);
        }

        function setCell(id, text, dataVal) {
            const el = document.getElementById(id);
            if (!el) return;
            el.innerText = text;
            if (dataVal !== undefined && dataVal !== null && dataVal !== '') {
                el.setAttribute('data-val', dataVal);
            } else {
                el.removeAttribute('data-val');
            }
        }

        function renderCompareTable() {
            const cat = categoriesData.find(c => c.id === activeCategoryId);
            if (!cat) return;

            for (let i = 0; i < 2; i++) {
                const brandId = selectedBrandIds[i];
                const brand = brandId ? cat.brands.find(b => b.id === brandId) : null;
                const head = document.getElementById(`slot-head-${i}`);

                if (brand) {
                    head.innerHTML = `
                        <div class="flex flex-col items-center">
                            <button onclick="clearSlot(${i})" class="absolute top-4 right-4 text-slate-400 hover:text-red-500 p-1.5 rounded-full transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            <span class="text-xs font-semibold text-accent uppercase bg-navy-900 px-2.5 py-0.5 rounded-full mb-2">Produk ${i + 1}</span>
                            <h2 class="text-base font-extrabold text-navy-900 text-center px-4 leading-tight">${brand.name}</h2>
                        </div>`;

                    setCell(`row-harga-${i}`, brand.harga ? 'Rp ' + brand.harga.toLocaleString('id-ID') : '-', brand.harga);
                    setCell(`row-kualitas-${i}`, brand.kualitas ? brand.kualitas.toFixed(2) : '-', brand.kualitas);
                    setCell(`row-minat-${i}`, brand.minat_pasar ? brand.minat_pasar.toFixed(2) : '-', brand.minat_pasar);

                    // Hasil — hanya tampil setelah tombol bandingkan diklik
                    if (comparisonDone) {
                        setCell(`row-saw_score-${i}`, brand.saw_score ? brand.saw_score.toFixed(4) : '0.0000', brand.saw_score || 0);
                    } else {
                        setCell(`row-saw_score-${i}`, '-', null);
                    }
                    setCell(`row-rank-${i}`, '-', null);

                } else {
                    const available = cat.brands.filter(b => !selectedBrandIds.includes(b.id));
                    let opts = '<option value="">-- Pilih Produk --</option>';
                    available.forEach(b => { opts += `<option value="${b.id}">${b.name}</option>`; });

                    head.innerHTML = `
                        <div class="flex flex-col items-center py-2">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-3">Pilih Produk ${i + 1}</span>
                            <select onchange="selectBrand(${i}, this.value)" class="w-full text-sm bg-white border border-slate-200 rounded-xl px-3 py-2 shadow-sm font-semibold text-slate-700 focus:outline-none focus:border-accent">
                                ${opts}
                            </select>
                        </div>`;

                    ['harga', 'kualitas', 'minat', 'saw_score'].forEach(f => setCell(`row-${f}-${i}`, '-', null));
                    const rankEl = document.getElementById(`row-rank-${i}`);
                    if (rankEl) { rankEl.innerHTML = '-'; rankEl.removeAttribute('data-val'); }
                }
            }

            updateActionBar();
            if (comparisonDone) computeRank();
            applyHighlights();
        }

        window.runComparison = function () {
            comparisonDone = true;
            renderCompareTable();
        };

        function computeRank() {
            const cat = categoriesData.find(c => c.id === activeCategoryId);
            if (!cat) return;
            const brands = selectedBrandIds.map(id => id ? cat.brands.find(b => b.id === id) : null);
            if (!brands[0] || !brands[1]) return;

            const scores = [brands[0].saw_score || 0, brands[1].saw_score || 0];

            for (let i = 0; i < 2; i++) {
                const mine = scores[i], other = scores[1 - i];
                let rank, cls;
                if (mine > other)      { rank = 1; cls = 'bg-amber-100 text-amber-800'; }
                else if (mine < other) { rank = 2; cls = 'bg-slate-100 text-slate-600'; }
                else                   { rank = 1; cls = 'bg-blue-100 text-blue-800'; }

                const el = document.getElementById(`row-rank-${i}`);
                el.innerHTML = `<span class="inline-block px-3 py-1 rounded-full text-xs font-bold ${cls}">Peringkat ${rank}</span>`;
                el.setAttribute('data-val', rank);
            }
        }

        window.resetComparison = function () {
            comparisonDone = false;
            selectedBrandIds = [null, null];
            renderCompareTable();
            updateUrl();
        };

        window.selectBrand = function (slotIndex, brandId) {
            if (!brandId) return;
            comparisonDone = false;
            selectedBrandIds[slotIndex] = parseInt(brandId);
            renderCompareTable();
            updateUrl();
        };

        window.clearSlot = function (slotIndex) {
            comparisonDone = false;
            selectedBrandIds[slotIndex] = null;
            renderCompareTable();
            updateUrl();
        };

        function applyHighlights() {
            const cls = ['bg-emerald-50/50', 'text-emerald-700', 'font-bold', 'border-l-4', 'border-emerald-500'];
            for (let i = 0; i < 2; i++) {
                ['row-harga', 'row-kualitas', 'row-minat', 'row-saw_score', 'row-rank'].forEach(id => {
                    const el = document.getElementById(`${id}-${i}`);
                    if (el) cls.forEach(c => el.classList.remove(c));
                });
            }
            if (!highlightBest) return;
            highlightRow('harga', 'min');
            highlightRow('kualitas', 'max');
            highlightRow('minat', 'max');
            if (comparisonDone) {
                highlightRow('saw_score', 'max');
                highlightRow('rank', 'min');
            }
        }

        function highlightRow(field, type) {
            const vals = [];
            for (let i = 0; i < 2; i++) {
                const el = document.getElementById(`row-${field}-${i}`);
                if (el && el.hasAttribute('data-val') && el.getAttribute('data-val') !== '') {
                    const v = parseFloat(el.getAttribute('data-val'));
                    if (!isNaN(v)) vals.push({ index: i, value: v });
                }
            }
            if (vals.length < 2) return;
            const best = type === 'min' ? Math.min(...vals.map(v => v.value)) : Math.max(...vals.map(v => v.value));
            vals.forEach(v => {
                if (v.value === best) {
                    const el = document.getElementById(`row-${field}-${v.index}`);
                    if (el) el.classList.add('bg-emerald-50/50', 'text-emerald-700', 'font-bold', 'border-l-4', 'border-emerald-500');
                }
            });
        }
    </script>
</body>
</html>
