<?php

namespace Tests\Unit\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function test_user_knows_if_is_admin(): void
    {
        $admin = new User();
        $admin->is_admin = true;

        $user = new User();
        $user->is_admin = false;

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($user->isAdmin());
    }

}
