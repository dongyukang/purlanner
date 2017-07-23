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
    public function count_type_exams_if_there_are_two_exams()
    {
      $task = [
        'title' => 'fake title',
        'type' => 'exam',
        'course_id' => factory(\App\Course::class)->create()->id,
        'location' => 'some classroom',
        'note' => 'some note',
        'due_date' => Carbon::tomorrow()
      ];

      $this->user()->assignTask($task);
      $this->user()->assignTask($task);

      $response = collect($this->user()->exams())->count();

      $this->assertEquals(2, $response);
    }
}
