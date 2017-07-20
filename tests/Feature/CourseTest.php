<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CourseTest extends TestCase
{
  use DatabaseTransactions;

  /** @test */
  public function save_course_into_database()
  {
    $user = factory(\App\User::class)->create();

    $data = [
      'subject'       => 'ASTR',
      'course_number' => '26400',
      'course_title'  => 'Descriptive Astronomy: Stars And Galaxies'
    ];

    $response = $user->saveCourse($data);

    $this->assertTrue($response);
  }

  /** @test */
  public function user_cannot_take_multiple_same_courses()
  {
    $user = factory(\App\User::class)->create();

    $data = [
      'subject'       => 'ASTR',
      'course_number' => '26400',
      'course_title'  => 'Descriptive Astronomy: Stars And Galaxies'
    ];

    $first = $user->saveCourse($data);

    $second = $user->saveCourse($data);

    $this->assertFalse($second);
  }

  /** @test */
  public function if_user_is_assigned_to_non_existed_course_then_course_should_be_created()
  {
    $user = factory(\App\User::class)->create();

    $data = [
      'subject'       => 'ASTR',
      'course_number' => '26400',
      'course_title'  => 'Descriptive Astronomy: Stars And Galaxies'
    ];

    $user->saveCourse($data);

    $response = \App\Course::where('subject' ,'ASTR')
                            ->where('course_number', '26400')
                            ->where('course_title', 'Descriptive Astronomy: Stars And Galaxies')
                            ->first() != null ? true : false;

    $this->assertTrue($response);
  }

}
