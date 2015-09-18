@foreach ($items as $item)
    
    <div class="utils-border-bottom">

    @if ($item->activity_type == 'content') 

        @include('component.row', [
            'image' => $user->imagePreset(),
            'text' => trans('user.activity.index.row.content', [
                'user' => $user->name,
                'title' => '<a href="'
                    . route('content.show', [$item->type, $item->id])
                    . '">'
                    . $item->title
                    . '</a>',
                'created_at' => $item->created_at->diffForHumans()
            ]),
            'options' => '-narrow -small'
        ])

    @else

        @include('component.row', [
            'image' => $user->imagePreset(),
            'text' => trans('user.activity.index.row.comment', [
                'user' => $user->name,
                'title' => '<a href="'
                    . route('content.show', [$item->content->type, $item->content->id])
                    . '">'
                    . $item->content->title
                    . '</a>',
                'comment_title' => '<a href="'
                    . route('content.show', [$item->content->type, $item->content->id, '#comment-' . $item->id])
                    . '">'
                    . $item->title
                    . '</a>',
                'created_at' => $item->created_at->diffForHumans()
            ]),
            'options' => '-small'
        ])

    @endif

    </div>

@endforeach