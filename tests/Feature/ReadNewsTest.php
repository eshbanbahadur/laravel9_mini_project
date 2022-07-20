<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadNewsTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function read_all_tasks()
    {

        $this->withoutExceptionHandling();
              //Given we have an authenticated user
           $user=User::factory()->create();
            $this->actingAs($user);
        //Given we have task in the database
        $task = \App\Models\News::factory()->create();

        //When user visit the news page
        $response = $this->get('/news');

        //He should be able to read the news
        $this->assertEquals(1,\App\Models\News::all()->count());

        return response()->json(['data'=>$response]);


    }
}
