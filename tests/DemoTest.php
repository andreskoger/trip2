<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Content;
use App\Comment;
use Carbon\Carbon;

class DemoTest extends TestCase
{
    use DatabaseTransactions;

    public function test_regular_user_can_create_and_edit_comment()
    {
    
        $content = factory(Content::class)->create([
            'user_id' => factory(App\User::class)->create()->id,
            'type' => 'forum'
        ]);

        $first_date = Content::find($content->id)->updated_at;
        
        sleep(2);

        $content->update(['title' => 'Updated']);

        $second_date = Content::find($content->id)->updated_at;

        dump($first_date->lt($second_date));

    }

}
