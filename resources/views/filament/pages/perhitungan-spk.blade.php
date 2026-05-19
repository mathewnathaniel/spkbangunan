<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Bobot Kriteria AHP --}}
        <x-filament::section icon="heroicon-o-chart-pie" heading="Bobot Kriteria Hasil AHP">
            @if(count($ahpWeights) > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    @foreach($this->getCriterias() as $criteria)
                        @php $weight = $ahpWeights[$criteria->id] ?? 0; @endphp
                        <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 flex flex-col items-center justify-center">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">{{ $criteria->name }}</h4>
                            <p class="text-4xl font-bold tracking-tight text-primary-600 dark:text-primary-400">
                                {{ number_format($weight * 100, 1) }}%
                            </p>
                            <div class="mt-3">
                                <x-filament::badge :color="$criteria->type === 'cost' ? 'danger' : 'success'">
                                    {{ strtoupper($criteria->type) }}
                                </x-filament::badge>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Consistency Ratio --}}
                <div class="rounded-xl border p-5 {{ $consistencyData['consistent'] ? 'bg-success-50/50 border-success-200 dark:bg-success-500/10 dark:border-success-500/20' : 'bg-danger-50/50 border-danger-200 dark:bg-danger-500/10 dark:border-danger-500/20' }}">
                    <div class="flex items-center gap-3 mb-4">
                        @if($consistencyData['consistent'])
                            <x-filament::icon icon="heroicon-o-check-circle" class="h-6 w-6 text-success-500" />
                            <h4 class="font-semibold text-success-700 dark:text-success-400">Matriks Konsisten</h4>
                        @else
                            <x-filament::icon icon="heroicon-o-x-circle" class="h-6 w-6 text-danger-500" />
                            <h4 class="font-semibold text-danger-700 dark:text-danger-400">Matriks Tidak Konsisten (Harap perbaiki nilai perbandingan)</h4>
                        @endif
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-3 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                            <span class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-medium">Lambda Max (λ max)</span>
                            <p class="text-lg font-semibold mt-1">{{ $consistencyData['lambda_max'] }}</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-3 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                            <span class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-medium">Consistency Index (CI)</span>
                            <p class="text-lg font-semibold mt-1">{{ $consistencyData['ci'] }}</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-3 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-medium">Consistency Ratio (CR)</span>
                                <p class="text-lg font-semibold mt-1 {{ $consistencyData['cr'] <= 0.1 ? 'text-success-600 dark:text-success-400' : 'text-danger-600 dark:text-danger-400' }}">
                                    {{ $consistencyData['cr'] }}
                                </p>
                            </div>
                            <span class="text-xs text-gray-400">(Batas: ≤ 0.1)</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center p-6 text-center">
                    <x-filament::icon icon="heroicon-o-information-circle" class="h-10 w-10 text-gray-400 mb-3" />
                    <p class="text-gray-500 dark:text-gray-400">Belum ada data perbandingan AHP. Tambahkan data di menu Perbandingan AHP terlebih dahulu.</p>
                </div>
            @endif
        </x-filament::section>

        {{-- Matriks Perbandingan AHP --}}
        <x-filament::section icon="heroicon-o-table-cells" heading="Matriks Perbandingan Berpasangan AHP">
            @php $matrix = $this->getMatrix(); $criterias = $this->getCriterias(); @endphp
            @if(count($matrix) > 0)
                <div class="rounded-xl overflow-hidden ring-1 ring-gray-950/5 dark:ring-white/10">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-gray-800/50">
                                <tr>
                                    <th class="px-4 py-3 font-medium text-gray-500 dark:text-gray-400 whitespace-nowrap">Kriteria</th>
                                    @foreach($criterias as $c)
                                        <th class="px-4 py-3 font-medium text-gray-500 dark:text-gray-400 text-center whitespace-nowrap">{{ $c->name }}</th>
                                    @endforeach
                                    <th class="px-4 py-3 font-semibold text-primary-600 dark:text-primary-400 text-center whitespace-nowrap bg-primary-50 dark:bg-primary-900/20">Bobot</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                                @foreach($matrix as $i => $row)
                                    @php $criteriaId = $criterias[$i]->id ?? null; @endphp
                                    <tr class="bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition duration-75">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ $row['name'] }}</td>
                                        @foreach($row['values'] as $val)
                                            <td class="px-4 py-3 text-center text-gray-600 dark:text-gray-400">{{ $val['display'] }}</td>
                                        @endforeach
                                        <td class="px-4 py-3 text-center font-bold text-primary-600 dark:text-primary-400 bg-primary-50/50 dark:bg-primary-900/10">
                                            {{ $criteriaId ? number_format(($ahpWeights[$criteriaId] ?? 0) * 100, 1) . '%' : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-center py-4">Belum ada data kriteria.</p>
            @endif
        </x-filament::section>

        {{-- Hasil Ranking SAW --}}
        <x-filament::section 
            icon="heroicon-o-trophy" 
            heading="Hasil Ranking Brand (Metode SAW)" 
            description="Klik tombol 'Hitung Ulang Ranking' di atas untuk memperbarui hasil perhitungan."
        >
            @if(count($rankingResults) > 0)
                <div class="space-y-8">
                    @foreach($rankingResults as $categoryName => $results)
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Kategori: {{ $categoryName }}</h3>
                            <div class="rounded-xl overflow-hidden ring-1 ring-gray-950/5 dark:ring-white/10">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left">
                                        <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-white/5">
                                            <tr>
                                                <th class="px-4 py-3 font-medium text-gray-500 dark:text-gray-400 text-center">Rank</th>
                                                <th class="px-4 py-3 font-medium text-gray-500 dark:text-gray-400">Brand</th>
                                                <th class="px-4 py-3 font-medium text-gray-500 dark:text-gray-400 text-center">Harga (norm.)</th>
                                                <th class="px-4 py-3 font-medium text-gray-500 dark:text-gray-400 text-center">Kualitas (norm.)</th>
                                                <th class="px-4 py-3 font-medium text-gray-500 dark:text-gray-400 text-center">Minat Pasar (norm.)</th>
                                                <th class="px-4 py-3 font-semibold text-primary-600 dark:text-primary-400 text-center bg-primary-50 dark:bg-primary-900/20">Skor Akhir</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                                            @foreach($results as $result)
                                                @php
                                                    $details = is_array($result['detail_scores']) ? $result['detail_scores'] : json_decode($result['detail_scores'] ?? '{}', true);
                                                    $rank = $result['ranking'];
                                                    
                                                    $rowClass = 'bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800/50';
                                                    if ($rank === 1) $rowClass = 'bg-amber-50/50 dark:bg-amber-900/10 hover:bg-amber-50 dark:hover:bg-amber-900/20';
                                                    elseif ($rank === 2) $rowClass = 'bg-gray-50 dark:bg-gray-800/30 hover:bg-gray-100 dark:hover:bg-gray-800/50';
                                                    elseif ($rank === 3) $rowClass = 'bg-orange-50/30 dark:bg-orange-900/10 hover:bg-orange-50/50 dark:hover:bg-orange-900/20';
                                                    
                                                    $medal = match($rank) {
                                                        1 => '🥇',
                                                        2 => '🥈',
                                                        3 => '🥉',
                                                        default => $rank,
                                                    };
                                                @endphp
                                                <tr class="{{ $rowClass }} transition duration-75">
                                                    <td class="px-4 py-3 text-center font-bold {{ $rank <= 3 ? 'text-2xl' : 'text-gray-500 dark:text-gray-400' }}">{{ $medal }}</td>
                                                    <td class="px-4 py-3 font-semibold text-gray-900 dark:text-white">{{ $result['brand']['name'] }}</td>
                                                    <td class="px-4 py-3 text-center">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($details['harga']['normalized'] ?? 0, 4) }}</div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">× {{ number_format($details['harga']['weight'] ?? 0, 3) }}</div>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($details['kualitas']['normalized'] ?? 0, 4) }}</div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">× {{ number_format($details['kualitas']['weight'] ?? 0, 3) }}</div>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($details['minat_pasar']['normalized'] ?? 0, 4) }}</div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">× {{ number_format($details['minat_pasar']['weight'] ?? 0, 3) }}</div>
                                                    </td>
                                                    <td class="px-4 py-3 text-center font-bold text-lg text-primary-600 dark:text-primary-400 bg-primary-50/50 dark:bg-primary-900/10">
                                                        {{ number_format((float) $result['final_score'], 4) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center p-8 text-center bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
                    <x-filament::icon icon="heroicon-o-clipboard-document-list" class="h-12 w-12 text-gray-400 mb-4" />
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Belum ada hasil ranking</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pastikan data brand dan penilaian sudah diisi, lalu klik "Hitung Ulang Ranking".</p>
                </div>
            @endif
        </x-filament::section>

    </div>
</x-filament-panels::page>
