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

        $superuser = factory(App\User::class)->create(['role' => 'superuser']);

        $types = collect([
            'forum' => 'assertEquals',
            'flight' => 'assertGreaterThan'
        ])->each(function($assertion, $type) use ($superuser) {

            $content = factory(Content::class)->create([
                'user_id' =>$superuser->id,
                'type' => $type
            ]);

            $first_date = Content::find($content->id)->updated_at;

            sleep(1);

            $this->actingAs($superuser)
                ->visit("content/$type/$content->id/edit")
                ->type("Hola titulo", 'title')
                ->press(trans('content.edit.submit.title'));

            $second_date = Content::find($content->id)->updated_at;

            $this->$assertion($first_date->timestamp, $second_date->timestamp, "Type: $type");
            
        });

    }

}
