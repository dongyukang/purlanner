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

        $response = $user->takesCourse($data);

        $this->assertTrue($response);
    }

  /** @test */
    public function another_user_wants_to_save_already_existing_course_into_database()
    {
        $james = factory(\App\User::class)->create();

        $sam = factory(\App\User::class)->create();

        $data = [
        'subject'       => 'ASTRA',
        'course_number' => '26400',
        'course_title'  => 'Descriptive Astronomy: Stars And Galaxies'
        ];

        $jamesSavingCourse = $james->saveCourse($data);

        $samSavingCourse = $sam->saveCourse($data);

        $courseUsers = collect(\App\Course::where('subject', 'ASTRA')
                ->where('course_number', '26400')
                ->first()
                ->users()
                ->get());

        $this->assertEquals(2, $courseUsers->count());
    }

  /** @test */
    public function detach_course_data_from_user()
    {
        $user = factory(\App\User::class)->create();

        $course_data = [
        'subject'       => 'some course',
        'course_number' => '10001',
        'course_title'  => 'this is a test course'
        ];

        $user->saveCourse($course_data);

        $course_id = \App\Course::where('subject', 'some course')
                            ->where('course_number', '10001')
                            ->where('course_title', 'this is a test course')
                            ->first()
                            ->id;

        $response = $user->removeCourse($course_id);

        $this->assertTrue($response);
    }

  /** @test */
    public function try_to_remove_none_existing_course_should_return_false()
    {
        $user = factory(\App\User::class)->create();

        $response = $user->removeCourse(3);

        $this->assertFalse($response);
    }
}
