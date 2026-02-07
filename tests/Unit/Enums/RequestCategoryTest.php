<?php

namespace Tests\Unit\Enums;

use App\Enums\RequestCategory;
use PHPUnit\Framework\TestCase;

class RequestCategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_request_category_has_correct_labels(): void
    {
        $this->assertEquals('Manutenção', RequestCategory::MAINTENANCE->label());
        $this->assertEquals('TI', RequestCategory::IT->label());
        $this->assertEquals('Financeiro', RequestCategory::FINANCIAL->label());
    }
}
