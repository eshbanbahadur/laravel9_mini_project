<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use DB;

class DeleteNewsTest extends TestCase
{
    use DatabaseMigrations;

   /** @test */
 public function delete_the_news(){

    //Given we have a signed in user
    $user=User::factory()->create();
    $this->actingAs($user);
    //And a news which is created by the user
    $news =\App\Models\News::factory()->create(['user_id' => 1]);
    //When the user hit's the endpoint to update the news
    $response=$this->post('/news/'.$news->id, $news->toArray());
    //The task should be updated in the database.
    $this->assertDatabaseMissing('News',['id'=> $news->id]);
    return response()->json(['data'=>$response]);



}
}

