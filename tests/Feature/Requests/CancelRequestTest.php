<?php

namespace Tests\Feature\Requests;

use App\Enums\RequestStatus;
use App\Livewire\RequestItem;
use App\Models\Request;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CancelRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_cancel_request(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $request = Request::factory()->create([
            'status' => RequestStatus::OPEN,
            'user_id' => $admin->id,
        ]);

        Livewire::actingAs($admin)
            ->test(RequestItem::class, ['request' => $request])
            ->call('openCancelModal')
            ->call('cancel');

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => RequestStatus::CANCELLED,
        ]);
    }
}
