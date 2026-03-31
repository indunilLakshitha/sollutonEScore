<?php

namespace App\Livewire\Admin\CompanySales;

use App\Models\CompanyMonthlySale;
use App\Services\ManagementIncomeService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    private const MIN_ENTRY_YEAR = 2026;

    private const MAX_ENTRY_YEAR = 2050;

    /** Calendar month for the entry (HTML month input: YYYY-MM). */
    public ?string $salesEntryMonth = null;

    public ?string $salesCountEntry = null;

    /** @var array<int, array{year: int, month: int, sales_count: int}> */
    public array $companySalesRows = [];

    public function mount(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->salesEntryMonth = $this->clampEntryMonthString(now()->format('Y-m'));
        $this->refreshCompanySalesRows();
    }

    public function save(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->validate([
            'salesEntryMonth' => 'required|date_format:Y-m',
            'salesCountEntry' => 'required|integer|min:0|max:100000000',
        ]);

        $parts = explode('-', (string) $this->salesEntryMonth);
        $year = (int) ($parts[0] ?? 0);
        $month = (int) ($parts[1] ?? 0);
        if ($year < self::MIN_ENTRY_YEAR || $year > self::MAX_ENTRY_YEAR || $month < 1 || $month > 12) {
            $this->addError('salesEntryMonth', 'Choose a month between '.self::MIN_ENTRY_YEAR.' and '.self::MAX_ENTRY_YEAR.'.');

            return;
        }

        $count = (int) $this->salesCountEntry;

        CompanyMonthlySale::query()->updateOrCreate(
            [
                'year' => $year,
                'month' => $month,
            ],
            [
                'sales_count' => $count,
            ]
        );

        app(ManagementIncomeService::class)->syncForMonth($year, $month);

        $this->refreshCompanySalesRows();
        $this->salesCountEntry = null;
        $this->dispatch('success_alert', ['title' => 'Company sales count saved for '.sprintf('%04d-%02d', $year, $month).'.']);
    }

    private function refreshCompanySalesRows(): void
    {
        $this->companySalesRows = CompanyMonthlySale::query()
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get(['year', 'month', 'sales_count'])
            ->map(fn (CompanyMonthlySale $r): array => [
                'year' => (int) $r->year,
                'month' => (int) $r->month,
                'sales_count' => (int) ($r->sales_count ?? 0),
            ])
            ->values()
            ->all();
    }

    private function clampEntryMonthString(string $ym): string
    {
        $parts = explode('-', $ym);
        $y = (int) ($parts[0] ?? self::MIN_ENTRY_YEAR);
        $m = (int) ($parts[1] ?? 1);
        $y = max(self::MIN_ENTRY_YEAR, min(self::MAX_ENTRY_YEAR, $y));
        $m = max(1, min(12, $m));

        return sprintf('%04d-%02d', $y, $m);
    }

    public function render()
    {
        return view('livewire.admin.company-sales.index');
    }
}
