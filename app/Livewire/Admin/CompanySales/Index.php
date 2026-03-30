<?php

namespace App\Livewire\Admin\CompanySales;

use App\Models\CompanyMonthlySale;
use App\Services\ManagementIncomeService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public int $year = 0;

    /** @var array<int, string|null> */
    public array $salesCountInputs = [];

    public function mount(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->year = (int) now()->format('Y');
        $this->loadSalesCounts();
    }

    public function updatedYear(): void
    {
        $this->loadSalesCounts();
    }

    public function save(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->validate([
            'year' => 'required|integer|min:2000|max:2100',
            'salesCountInputs' => 'required|array|size:12',
            'salesCountInputs.*' => 'nullable|integer|min:0|max:100000000',
        ]);

        for ($month = 1; $month <= 12; $month++) {
            $raw = $this->salesCountInputs[$month] ?? null;

            if ($raw === null || $raw === '') {
                CompanyMonthlySale::query()
                    ->where('year', $this->year)
                    ->where('month', $month)
                    ->delete();
                app(ManagementIncomeService::class)->syncForMonth($this->year, $month);
                continue;
            }

            CompanyMonthlySale::query()->updateOrCreate(
                [
                    'year' => $this->year,
                    'month' => $month,
                ],
                [
                    'sales_count' => (int) $raw,
                ]
            );

            app(ManagementIncomeService::class)->syncForMonth($this->year, $month);
        }

        $this->loadSalesCounts();
        $this->dispatch('success_alert', ['title' => 'Company monthly sales saved.']);
    }

    private function loadSalesCounts(): void
    {
        $this->salesCountInputs = [];
        for ($month = 1; $month <= 12; $month++) {
            $this->salesCountInputs[$month] = null;
        }

        $rows = CompanyMonthlySale::query()
            ->where('year', $this->year)
            ->get(['month', 'sales_count']);

        foreach ($rows as $row) {
            $this->salesCountInputs[(int) $row->month] = (string) ((int) $row->sales_count);
        }
    }

    public function render()
    {
        return view('livewire.admin.company-sales.index');
    }
}
