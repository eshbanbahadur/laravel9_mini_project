<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\News;
use App\Models\User;
use DB;
use Auth;


class UpdateNewsTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function update_the_news(){
        $this->withoutExceptionHandling();

     //Given we have a signed in user
     $user=User::factory()->create();
    $this->actingAs($user);
         //And a News which is created by the user
    $news = \App\Models\News::factory()->create(['user_id' => 1]);
    $news->title = "Updated Title";
    $news->news_id=1;
    //When the user hit's the endpoint to update the task
    $response=$this->post('/news/', $news->toArray());
    //The task should be updated in the database.
    $this->assertDatabaseHas('news',['title' => 'Updated Title']);
    return response()->json(['data'=>$response]);
    }
}
