<?php

namespace App\Livewire;

use App\Models\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class RequestItem extends Component
{
    use AuthorizesRequests;

    public Request $request;
    public bool $showConfirmModal = false;

    public function openCancelModal(): void
    {
        $this->showConfirmModal = true;
    }

    public function cancel()
    {
        $this->authorize('cancel', $this->request);

        $this->request->update([
            'status' => 'cancelled',
        ]);

        $this->dispatch('request-cancelled');

        $this->dispatch('toast', message: 'Solicitação cancelada com sucesso', type: 'success');

    }
    public function render()
    {
        return view('livewire.request-item');
    }
}
