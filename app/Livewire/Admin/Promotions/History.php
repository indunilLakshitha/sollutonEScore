<?php

namespace App\Livewire\Admin\Promotions;

use App\Models\PromotionHistory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Artisan;

class History extends Component
{
    use WithPagination;

    public $search = '';
    public $promotionFilter = '';
    public $userFilter = '';
    public $availableUsers = [];
    public $isRunning = false;

    public function mount()
    {
        // dd('asdasd');
    }

    public function runRankingCron()
    {

        // $this->isRunning = true;
        // $this->dispatch('run-ranking-cron');
        // Run the artisan command directly
        Artisan::call('ranking:update');

        // Reset the button state after 5 seconds
        // $this->js('setTimeout(function() {
        //     $wire.isRunning = false;
        // }, 5000)');
    }

    public function filter()
    {
        $this->resetPage();
    }

    public function searchUsers()
    {
        if (strlen($this->search) >= 3) {
            $this->availableUsers = \App\Models\User::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('id', 'like', '%' . $this->search . '%');
            })
                ->limit(50)
                ->get();
        } else {
            $this->availableUsers = [];
        }
    }

    public function selectUser($id)
    {
        $this->search = $id;
        $this->availableUsers = [];
    }
    public function render()
    {
        $histories = PromotionHistory::with(['promotion', 'user'])
            ->when(strlen($this->search) >= 3, function ($query) {
                $query->whereHas('user', function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('id', 'like', '%' . $this->search . '%');
                })->orWhereHas('promotion', function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->promotionFilter, function ($query) {
                $query->where('promotion_id', $this->promotionFilter);
            })
            ->orderBy('achived_at', 'desc')
            ->limit(50)
            ->paginate(20);

        // Load limited dropdown options to prevent memory issues
        $promotions = \App\Models\Promotion::select('id', 'name')
            ->limit(100)
            ->get();



        return view('livewire.admin.promotions.history', compact('histories', 'promotions'));
    }
}
