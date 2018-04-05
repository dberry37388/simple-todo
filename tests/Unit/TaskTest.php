<?php

namespace Tests\Unit;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \App\Thread
     */
    protected $thread;

    protected function setUp()
    {
        parent::setUp();

        $this->task = create(Task::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testATaskHasAUser()
    {
        $this->assertInstanceOf(User::class, $this->task->creator);
    }
}
