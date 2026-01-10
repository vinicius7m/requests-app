<?php

namespace App\Livewire;

use App\Models\Request;
use Livewire\Component;
use Livewire\WithPagination;

class RequestList extends Component
{

    use WithPagination;

    public string $status = 'all';

    protected $queryString = [
        'status' => ['except' => 'all']
    ];

    public function updatedStatus($value)
    {
        // if (! in_array($value, ['all', 'open', 'approved', 'rejected'])) {
        //     $this->status = 'all';
        // }

        $this->resetPage();
    }


    public function render()
    {
        $requests = Request::query()
            ->where('user_id', 1)
            ->when($this->status !== 'all', fn($query) =>
                $query->where('status', $this->status)
            )
            ->latest()
            ->paginate(10);

        return view('livewire.request-list', [
            'requests' => $requests,
        ]);
    }
}
