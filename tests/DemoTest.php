<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Content;
use App\Comment;
use Carbon\Carbon;

class DemoTest extends TestCase
{
    use DatabaseTransactions;

    public function test_forum_content_do_not_update_timestamp_on_update()
    {
    
        $regular_user = factory(App\User::class)->create();

        $type = 'forum';

        $content = factory(Content::class)->create([
            'user_id' => $regular_user->id,
            'type' => $type
        ]);

        $first_date = Content::find($content->id)->updated_at;
        
        /*
        sleep(2);

        $content->update(['title' => 'Updated']);

        $second_date = Content::find($content->id)->updated_at;

        $this->assertGreaterThan($first_date->timestamp, $second_date->timestamp);
        */

        $this->actingAs($regular_user)
            ->visit("content/$type/$content->id/edit")
            ->type("Hola titulo", 'title')
            ->press(trans('content.edit.submit.title'));

        $second_date = Content::find($content->id)->updated_at;

        $this->assertGreaterThan($first_date->timestamp, $second_date->timestamp);
        
    }

}
