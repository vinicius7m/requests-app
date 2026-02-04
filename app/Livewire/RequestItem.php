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

    public bool $showReviewModal = false;
    public string $action = '';
    public string $reason = '';

    public function openCancelModal(): void
    {
        $this->showConfirmModal = true;
    }

    public function openApproveModal(): void
    {
        $this->action = 'approve';
        $this->reason = '';
        $this->showReviewModal = true;
    }

    public function openRejectModal(): void
    {
        $this->action = 'reject';
        $this->reason = '';
        $this->showReviewModal = true;
    }

    public function cancel()
    {
        $this->authorize('cancel', $this->request);

        $this->request->cancel();

        $this->dispatch('request-cancelled');

        $this->dispatch('toast', message: 'Solicitação cancelada com sucesso!');
    }

    public function confirmReview()
    {
        $this->authorize('manage', $this->request);

        if($this->action === 'reject') {
            $this->validate([
                'reason' => 'required|min:5',
            ]);

            $this->request->reject($this->reason);

            $message = 'Solicitação rejeitada com sucesso!';
        }else {
            $this->request->approve($this->reason);

            $message = 'Solicitação aprovada com sucesso!';
        }

        $this->showReviewModal = false;

        $this->dispatch('request-reviewed');
        $this->dispatch('toast', message: $message);
    }

    public function render()
    {
        return view('livewire.request-item');
    }
}
