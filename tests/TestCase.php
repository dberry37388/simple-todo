<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Helper method for signing in an active user.
     *
     * @param null $user
     * @return \Tests\TestCase
     */
    protected function signIn($user = null)
    {
        $user = $user ? : create(User::class);

        $this->actingAs($user);

        return $this;
    }
}
