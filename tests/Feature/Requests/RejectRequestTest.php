<?php

namespace Tests\Feature\Requests;

use App\Enums\RequestStatus;
use App\Livewire\RequestItem;
use App\Models\Request;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RejectRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_admin_can_reject_request(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $request = Request::factory()->create([
            'status' => RequestStatus::OPEN,
        ]);

        Livewire::actingAs($admin)
            ->test(RequestItem::class, ['request' => $request])
            ->call('openRejectModal')
            ->set('reason', 'Reprovado pelo gestor')
            ->call('confirmReview');

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => RequestStatus::REJECTED,
            'reason' => 'Reprovado pelo gestor',
        ]);
    }
}
