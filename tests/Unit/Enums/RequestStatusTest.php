<?php

namespace Tests\Unit\Enums;

use App\Enums\RequestStatus;
use PHPUnit\Framework\TestCase;

class RequestStatusTest extends TestCase
{
    public function test_request_status_has_correct_labels(): void
    {
        $this->assertEquals('Aberta', RequestStatus::OPEN->label());
        $this->assertEquals('Aprovada', RequestStatus::APPROVED->label());
        $this->assertEquals('Rejeitada', RequestStatus::REJECTED->label());
        $this->assertEquals('Cancelada', RequestStatus::CANCELLED->label());
    }

    public function test_request_colors_has_correct_colors(): void
    {
        $this->assertEquals('text-white', RequestStatus::OPEN->color());
        $this->assertEquals('text-green-600', RequestStatus::APPROVED->color());
        $this->assertEquals('text-red-600', RequestStatus::REJECTED->color());
        $this->assertEquals('text-gray-500', RequestStatus::CANCELLED->color());
    }
}
