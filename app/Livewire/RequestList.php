<?php

namespace App\Livewire;

use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
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

    #[On('request-cancelled')]
    public function refreshList()
    {
        $this->resetPage();
    }

    #[On('request-reviewed')]
    public function refresh()
    {
        $this->resetPage();
    }


    public function render()
    {
        $isAdmin = Auth::user()->can('manage', Auth::user());

        $requests = Request::query()
            ->when(!$isAdmin, fn($query) =>
                $query->where('user_id', Auth::user()->id)
            )
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
