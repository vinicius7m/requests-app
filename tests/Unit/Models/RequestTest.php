<?php

namespace Tests\Unit\Models;

use App\Enums\RequestStatus;
use App\Exceptions\DomainException;
use App\Models\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_request_can_be_cancelled_when_open(): void
    {
        $request = Request::factory()->create([
            'status' => RequestStatus::OPEN,
        ]);

        $request->cancel();

        $this->assertSame($request->fresh()->status, RequestStatus::CANCELLED);
    }

    public function test_request_cannot_be_cancelled_when_not_open()
    {
        $request = Request::factory()->approved()->create([
            'status' => RequestStatus::APPROVED,
            'reason' => null,
        ]);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Solicitação não pode ser cancelada.');

        $request->cancel();
    }

    public function test_request_can_be_approved_with_reason(): void
    {
        $request = Request::factory()->create([
            'status' => RequestStatus::OPEN,
        ]);

        $request->approve('Aprovado pelo gestor');

        $request->refresh();

        $this->assertEquals($request->status, RequestStatus::APPROVED);
        $this->assertEquals($request->reason, 'Aprovado pelo gestor');
    }

    public function test_request_cannot_be_approved_if_not_open(): void
    {
        $request = Request::factory()->rejected()->create([
            'status' => RequestStatus::REJECTED,
        ]);

        $this->expectException(DomainException::class);
        $request->approve();
    }

    public function test_request_can_be_rejected_with_reason(): void
    {
        $request = Request::factory()->create([
            'status' => RequestStatus::OPEN,
        ]);

        $request->reject('Motivo da rejeição');

        $request->refresh();

        $this->assertEquals($request->reason, 'Motivo da rejeição');
        $this->assertEquals($request->status, RequestStatus::REJECTED);
    }

    public function test_request_cannot_be_rejected_if_not_open(): void
    {
        $request = Request::factory()->approved()->create([
            'status' => RequestStatus::APPROVED,
        ]);

        $this->expectException(DomainException::class);
        $request->reject('x');
    }

    public function test_request_cannot_be_rejected_without_reason(): void
    {
        $request = Request::factory()->create([
            'status' => RequestStatus::OPEN,
        ]);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Motivo da rejeição é obrigatório.');
        $request->reject();
    }

}
