{{--

title: User extra

code: |

    @include('component.user.extra', [
        'items' => [
            [
                'icon' => 'icon-offer',
                'title' => '123',
                'text' => 'Postitusi foorumis',
                'route' => ''
            ],
            [
                'icon' => 'icon-offer',
                'title' => '421',
                'text' => 'Külastatud sihtkohti',
                'route' => ''
            ],
        ]
    ])

--}}

<ul class="c-user-extra">

    @foreach($items as $item)

    <li class="c-user-extra__item">

        @if(isset($item['route']))

        <a href="{{ $item['route'] }}" class="c-user-extra__item-link">

        @endif

        @if(isset($item['icon']))

        <div class="c-user-extra__item-icon">

            @include('component.icon',[
                'icon' => $item['icon']
            ])

        </div>

        @endif

        @if(isset($item['title']))

        <div class="c-user-extra__item-title">

            {{ $item['title'] }}

        </div>

        @endif

        @if(isset($item['text']))

        <div class="c-user-extra__item-text">

            @include('component.tooltip',[
                'modifiers' => 'm-inverted m-bottom m-one-line',
                'text' => $item['text']
            ])

        </div>

        @endif

        @if(isset($item['route']))

        </a>

        @endif

    </li>

    @endforeach

</ul>