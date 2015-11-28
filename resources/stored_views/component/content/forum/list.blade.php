{{--

title: Forum list

code: |

    @include('component.content.forum.list', [
        'modifiers' => $modifiers,
        'items' => [
            [
                'topic' => 'This book is a record of a pleasure trip. If it were a record of a solemn scientific expedition',
                'route' => '#',
                'profile' => [
                    'modifiers' => 'm-mini',
                    'image' => \App\Image::getRandom()
                ],
                'badge' => [
                    'modifiers' => 'm-inverted',
                    'count' => 9
                ],
                'tags' => [
                    [
                        'title' => 'Inglismaa',
                        'modifiers' => 'm-green',
                        'route' => ''
                    ]
                ],
                'children' => [
                    [
                        'profile' => [
                            'modifiers' => 'm-mini',
                            'image' => \App\Image::getRandom(),
                            'title' => 'Charles Darwin',
                            'route' => ''
                        ],
                        'date' => '12. jaanuar, 12:31',
                        'text' => 'Mina puurisin nüüd juba mitu-mitu aastat tagasi oma Kagu-Aasia reiside eel samuti mitme (Eesti) kindlustusfirma tingimusi.',
                        'more' => [
                            'title' => 'Vaata kogu postitust',
                            'route' => ''
                        ]
                    ]
                ]
            ]
        ]
    ])

modifiers:

- m-compact

--}}

<ul class="c-forum-list {{ $modifiers or '' }}">

    @if(isset($items))

        @foreach ($items as $item)

            <li class="c-forum-list__item">

                @if (isset($item['route']))

                    <a href="{{ $item['route'] }}" class="c-forum-list__item-link">

                @else

                    <div class="c-forum-list__item-content">

                @endif

                @if (isset($item['profile']))

                    <div class="c-forum-list__item-profile">

                        @include('component.profile', [
                            'modifiers' => $item['profile']['modifiers'],
                            'image' => $item['profile']['image'],
                            'badge' => $item['badge']
                        ])

                    </div>

                @endif

                <h3 class="c-forum-list__item-topic">{{ $item['topic'] }}</h3>

                @if (isset($item['route']))

                    </a>

                @else

                    </div>

                @endif

                @if (isset($item['tags']))

                    <div class="c-forum-list__item-tags">

                        @include('component.tags', [
                            'modifiers' => 'm-small',
                            'items' => $item['tags']
                        ])

                    </div>

                @endif

                @if(isset($item['children']))

                    <ul class="c-forum-list__sublist">

                    @foreach ($item['children'] as $child)

                        <li class="c-forum-list__sublist-item">

                            @include('component.content.forum.post',[
                                'profile' => [
                                    'image' => $child['profile']['image'],
                                    'title' => $child['profile']['title'],
                                    'route' => $child['profile']['route']
                                ],
                                'date' => $child['date'],
                                'text' => $child['text'],
                                'more' => [
                                    'title' => $child['more']['title'],
                                    'route' => $child['more']['route']
                                ]
                            ])

                        </li>

                    @endforeach

                    </ul>

                @endif

            </li>

        @endforeach

    @endif

</ul>