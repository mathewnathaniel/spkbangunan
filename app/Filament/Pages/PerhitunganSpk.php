<?php

namespace App\Filament\Pages;

use App\Models\AhpComparison;
use App\Models\Criteria;
use App\Models\RankingResult;
use App\Services\SpkService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class PerhitunganSpk extends Page
{
    protected string $view = 'filament.pages.perhitungan-spk';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalculator;

    protected static ?string $navigationLabel = 'Perhitungan SPK';

    protected static ?string $title = 'Perhitungan AHP & SAW';

    protected static ?int $navigationSort = 4;

    public array $ahpWeights = [];
    public array $consistencyData = [];
    public array $rankingResults = [];
    public bool $calculated = false;

    public function mount(): void
    {
        $this->loadData();
    }

    protected function loadData(): void
    {
        $service = new SpkService();
        $this->ahpWeights      = $service->calculateAhpWeights();
        $this->consistencyData = $service->calculateConsistencyRatio();
        $results = RankingResult::with(['brand.category'])
            ->orderBy('ranking')
            ->get();

        $this->rankingResults = $results->groupBy(function($item) {
            return $item->brand->category->name ?? 'Lainnya';
        })->toArray();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('hitung')
                ->label('Hitung Ulang Ranking')
                ->icon(Heroicon::OutlinedArrowPath)
                ->color('primary')
                ->action(function () {
                    try {
                        $service = new SpkService();
                        $service->calculateSawRanking();
                        $this->loadData();
                        $this->calculated = true;

                        Notification::make()
                            ->title('Perhitungan berhasil!')
                            ->body('Ranking brand telah diperbarui menggunakan metode AHP & SAW.')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Terjadi kesalahan')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }

    public function getCriterias()
    {
        return Criteria::all();
    }

    private function formatAhpDisplay(float $value): string
    {
        // Jika angka bulat (misal 5)
        if ($value >= 1 && floor($value) == $value) {
            return (string) (int) $value;
        }
        
        // Jika angka pecahan (misal 0.2 -> 1/5, 0.333 -> 1/3)
        if ($value > 0 && $value < 1) {
            $denominator = round(1 / $value);
            return '1/' . $denominator;
        }
        
        // Fallback nilai desimal biasa
        return (string) round($value, 2);
    }

    public function getMatrix(): array
    {
        $criterias = Criteria::all();
        $matrix    = [];

        foreach ($criterias as $c1) {
            $row = ['name' => $c1->name, 'values' => []];
            foreach ($criterias as $c2) {
                if ($c1->id === $c2->id) {
                    $row['values'][] = ['display' => '1', 'value' => 1];
                } else {
                    $comparison = AhpComparison::where('criteria_1_id', $c1->id)
                        ->where('criteria_2_id', $c2->id)->first();
                        
                    if ($comparison) {
                        $val = (float) $comparison->value;
                        $row['values'][] = [
                            'display' => $this->formatAhpDisplay($val),
                            'value'   => $val,
                        ];
                    } else {
                        $reverseComparison = AhpComparison::where('criteria_1_id', $c2->id)
                            ->where('criteria_2_id', $c1->id)->first();
                            
                        if ($reverseComparison) {
                            $val = 1 / (float) $reverseComparison->value;
                            $row['values'][] = [
                                'display' => $this->formatAhpDisplay($val),
                                'value'   => $val,
                            ];
                        } else {
                            $row['values'][] = ['display' => '1', 'value' => 1];
                        }
                    }
                }
            }
            $matrix[] = $row;
        }

        return $matrix;
    }
}
