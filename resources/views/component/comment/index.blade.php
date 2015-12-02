@if (count($comments))

@foreach ($comments as $index => $comment)

    <div
        id="comment-{{ $comment->id }}"
        class="
        @if (count($comments) == ($index + 1))
            utils-padding-bottom
        @else
            utils-border-bottom
        @endif
        @if (! $comment->status)
            utils-unpublished
        @endif
    ">

        @include('component.row', [
            'profile' => [
                'modifiers' => 'm-small',
                'image' => $comment->user->imagePreset('xsmall_square'),
                'route' => route('user.show', [$comment->user])
            ],
            'text' => view('component.comment.text', ['comment' => $comment]),
            'actions' => view('component.actions', ['actions' => $comment->getActions()]),
            'extra' => view('component.flags', ['flags' => $comment->getFlags()]),
            'body' => nl2br($comment->body),
            'modifiers' => 'm-image'

        ])

    </div>

@endforeach

@endif
