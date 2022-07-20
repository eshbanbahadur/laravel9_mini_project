<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use DB;


class CreateNewsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
public function create_a_new_news()
{
    //Given we have an authenticated user
    $user=User::factory()->create();
    $this->actingAs($user);
    //And a news object
    $news = \App\Models\News::factory()->make();
    //When user submits post request to create news endpoint
    $response=$this->post('/news',$news->toArray());

    //It gets stored in the database
    $this->assertEquals(1,\App\Models\News::all()->count());
    return response()->json(['data'=>$response]);
}

}
