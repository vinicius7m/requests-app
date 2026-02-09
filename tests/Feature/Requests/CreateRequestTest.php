<?php

namespace Tests\Feature\Requests;

use App\Enums\RequestStatus;
use App\Livewire\CreateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateRequestTest extends TestCase
{
    /** @test */
    public function user_can_create_request(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CreateRequest::class)
            ->set('title', 'Solicitação de equipamento')
            ->set('description', 'Preciso de um novo notebook')
            ->set('category', 'ti')
            ->call('save')
            ->assertRedirect(route('requests.list'));

        $this->assertDatabaseHas('requests', [
            'title' => 'Solicitação de equipamento',
            'status' => RequestStatus::OPEN->value,
            'user_id' => $user->id,
        ]);
    }
}
