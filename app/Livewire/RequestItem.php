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

        $this->request->cancel();

        $this->dispatch('request-cancelled');

        $this->dispatch('toast', message: 'Solicitação cancelada com sucesso!');
    }

    public function approve()
    {
        $this->authorize('manage', $this->request);

        $this->request->approve();

        $this->dispatch('toast', message: 'Solicitação aprovada com sucesso!');
    }

    public function reject()
    {
        $this->authorize('manage', $this->request);

        $this->request->reject();

        $this->dispatch('toast', message: 'Solicitação rejeitada com sucesso!');
    }

    public function render()
    {
        return view('livewire.request-item');
    }
}
