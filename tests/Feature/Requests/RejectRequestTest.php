<?php

namespace Tests\Feature\Requests;

use App\Enums\RequestStatus;
use App\Models\Request;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RejectRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_reject_open_request_with_reason(): void
    {
        $user = User::factory()->create();

        $request = Request::factory()->create([
            'status' => RequestStatus::OPEN,
        ]);

        $response = $this
            ->actingAs($user)
            ->postJson("/requests/{$request->id}/reject", [
                'reason' => 'Documento inválido',
            ]);

        $response->assertOk();

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => RequestStatus::REJECTED->value,
            'reason' => 'Documento inválido',
        ]);
    }
}
