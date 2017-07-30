<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    protected $user = null;

    /**
     * Create User.
     *
     * @return \App\User
     */
    public function user()
    {
      if ($this->user == null) {
        $this->user = factory(\App\User::class)->create();
      }

      return $this->user;
    }

    /** @test */
    public function basic_task_assigning()
    {
      $task = [
        'title' => 'fake title',
        'type' => 'exam',
        'course_id' => factory(\App\Course::class)->create()->id,
        'location' => 'some classroom',
        'note' => 'some note',
        'due_date' => Carbon::tomorrow()
      ];

      $response = $this->user()->assignTask($task);

      $this->assertTrue($response);
    }

    /** @test */
    public function tasks_that_past_due_should_not_count_as_task()
    {
      $user = factory(\App\User::class)->create();

      $user->createDefaultTypes();

      $task = [
        'title' => 'fake title',
        'type' => 'exam',
        'course_id' => factory(\App\Course::class)->create()->id,
        'location' => 'some classroom',
        'note' => 'some note',
        'due_date' => Carbon::yesterday()
      ];

      $user->assignTask($task);

      $this->assertEquals(0, $user->countTask('exam'));
    }

    /** @test */
    public function types_that_have_zero_tasks_should_not_appear()
    {
      $user = factory(\App\User::class)->create();

      $user->createDefaultTypes();

      $task1 = [
        'title' => 'fake title',
        'type' => 'exam',
        'course_id' => factory(\App\Course::class)->create()->id,
        'location' => 'some classroom',
        'note' => 'some note',
        'due_date' => Carbon::tomorrow()
      ];

      $task2 = [
        'title' => 'fake title',
        'type' => 'assignment',
        'course_id' => factory(\App\Course::class)->create()->id,
        'location' => 'some classroom',
        'note' => 'some note',
        'due_date' => Carbon::tomorrow()
      ];

      $user->assignTask($task1);

      $user->assignTask($task2);

      $this->assertEquals(2, collect($user->getNoneZeroTypes())->count());
    }

    /** @test */
    public function two_different_courses_but_one_past_due_should_assert_one_task()
    {
      $user = factory(\App\User::class)->create();

      $user->createDefaultTypes();

      $task1 = [
        'title' => 'fake title',
        'type' => 'assignment',
        'course_id' => factory(\App\Course::class)->create()->id,
        'location' => 'some classroom',
        'note' => 'some note',
        'due_date' => Carbon::tomorrow()
      ];

      $task2 = [
        'title' => 'fake title',
        'type' => 'assignment',
        'course_id' => factory(\App\Course::class)->create()->id,
        'location' => 'some classroom',
        'note' => 'some note',
        'due_date' => Carbon::yesterday()
      ];

      $user->assignTask($task1);

      $user->assignTask($task2);

      $this->assertEquals(1, collect($user->getNoneZeroTypes())->count());
    }

    /** @test */
    public function two_same_courses_but_one_past_due_should_assert_one_valid_task()
    {
      $user = factory(\App\User::class)->create();

      $user->createDefaultTypes();

      $course_id = factory(\App\Course::class)->create()->id;

      $task1 = [
        'title' => 'fake title',
        'type' => 'assignment',
        'course_id' => $course_id,
        'location' => 'some classroom',
        'note' => 'some note',
        'due_date' => Carbon::tomorrow()
      ];

      $task2 = [
        'title' => 'fake title',
        'type' => 'assignment',
        'course_id' => $course_id,
        'location' => 'some classroom',
        'note' => 'some note',
        'due_date' => Carbon::yesterday()
      ];

      $user->assignTask($task1);

      $user->assignTask($task2);

      $this->assertEquals(1, collect($user->getNoneZeroTypes($course_id))->count());
    }

}
