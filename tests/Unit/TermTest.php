<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TermTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_is_created_and_default_types_are_created_default_types_should_be_four()
    {
      $user = factory(\App\User::class)->create();

      $user->createDefaultTypes();

      $this->assertEquals(4, $user->types()->count());
    }
}
