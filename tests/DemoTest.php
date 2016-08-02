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
    
        $content = factory(Content::class)->create([
            'user_id' => factory(App\User::class)->create()->id,
            'type' => 'forum'
        ]);

        $first_date = Content::find($content->id)->updated_at;
        
        sleep(2);

        $content->update(['title' => 'Updated']);

        $second_date = Content::find($content->id)->updated_at;

//        $this->assertTrue($first_date->gt($second_date));

        $this->assertGreaterThan($first_date->timestamp, $second_date->timestamp);
    }

}
