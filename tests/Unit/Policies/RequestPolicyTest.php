<?php

namespace Tests\Unit\Policies;

use App\Enums\RequestStatus;
use App\Models\Request;
use App\Models\User;
use App\Policies\RequestPolicy;
use PHPUnit\Framework\TestCase;

class RequestPolicyTest extends TestCase
{
    public function test_user_can_cancel_own_open_request(): void
    {
        $user = new User();
        $user->id = 1;
        $user->is_admin = false;

        $request = new Request();
        $request->user_id = 1;
        $request->status = RequestStatus::OPEN;

        $policy = new RequestPolicy();

        $this->assertTrue($policy->cancel($user, $request));
    }

    public function test_user_cannot_cancel_request_of_another_user (): void
    {
        $user = new User();
        $user->id = 1;

        $request = new Request();
        $request->user_id = 2;
        $request->status = RequestStatus::OPEN;

        $policy = new RequestPolicy();

        $this->assertFalse($policy->cancel($user, $request));
    }

    public function test_admin_can_manage_requests() {
        $user = new User();
        $user->is_admin = true;

        $policy = new RequestPolicy();

        $this->assertTrue($policy->manage($user));
    }
}
