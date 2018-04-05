<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAGuestMayNotCreateANewTask()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthenticationException::class);

        $task = make(Task::class);

        // send a post request to the endpoint
        $this->post(route('createTask'), $task->toArray());
    }

    /**
     * Tests that an authorized user can create
     * a new task.
     *
     * This is a user who is logged in.
     *
     * @return void
     */
    public function testAnAuthenticatedUserCanCreateANewTask()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $task = make(Task::class);

        // send a post request to the endpoint
        $response = $this->post(route('createTask'), $task->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($task->title)
            ->assertSee($task->description);
    }

    /**
     * Test that a task requires a title
     *
     * @return void
     */
    public function testATaskRequiresATitle()
    {
        $this->signIn();

        $this->createTask(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     * Test that a task required a description
     *
     * @return void
     */
    public function testATaskRequiresADescription()
    {
        $this->signIn();

        $this->createTask(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     * Tests that an unauthenticated user may not
     * update an existing task.
     *
     * This is a user who is logged in.
     *
     * @return void
     */
    public function testAnUnauthenticatedUserMayNotUpdateAnExistingTask()
    {
        $task = create(Task::class);

        $this->put(route('updateTask', $task), [])
            ->assertRedirect('login');

        $this->signIn();

        $this->put(route('updateTask', $task), [
            'title' => 'new title',
            'description' => 'new description'
        ])->assertStatus(403);
    }

    /**
     * Tests to make sure guests and unauthorized users
     * cannot delete a task.
     *
     * @return void
     */
    public function testUnauthorizedUsersMayNotDeleteTasks()
    {
        $this->withExceptionHandling();

        $task = create(Task::class);

        $this->delete(route('deleteTask', $task))
            ->assertRedirect('login');

        $this->signIn();

        $this->delete(route('deleteTask', $task))
            ->assertStatus(403);
    }

    /**
     * Tests that an authorized user can delete
     * an existing task.
     *
     * This is a user who is logged in.
     *
     * @return void
     */
    public function testAnAuthenticatedUserCanUpdateAnExistingTask()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $task = create(Task::class, [
            'user_id' => auth()->id()
        ]);

        // send a post request to the endpoint
        $newDetails = [
            'title' => 'New Title',
            'description' => 'This is my new description.'
        ];

        $this->json('PUT', route('deleteTask', $task), $newDetails)
            ->assertStatus(204);

        $this->get(route('showTask', $task))
            ->assertSee($newDetails['title'])
            ->assertSee($newDetails['description']);
    }

    /**
     * Tests that an authorized user can update
     * an existing task.
     *
     * This is a user who is logged in.
     *
     * @return void
     */
    public function testAnAuthenticatedUserCanDeleteAnExistingTask()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $task = create(Task::class, [
            'user_id' => auth()->id()
        ]);

        $this->json('DELETE', route('deleteTask', $task))
            ->assertStatus(204);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /**
     * Creates a new thread with the given overrides.
     *
     * @param array $overrides
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function createTask(array $overrides = [])
    {
        $task = make(Task::class, $overrides);

        return $this->post(route('createTask'), $task->toArray());
    }
}
