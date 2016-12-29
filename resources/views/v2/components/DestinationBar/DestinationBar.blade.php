@php

$route = $route ?? '';
$title = $title ?? '';
$parents = $parents ?? '';

@endphp

<div class="DestinationBar {{ $isclasses }}">

    <div>
            
            @if ($parents)

            <div class="DestinationBar__parents">

                {!! $parents  !!}

            </div>

            @endif
            
            <a href="{{ $route }}">

                <div class="DestinationBar__title">

                    {{ $title }} ›

                </div>

            </a>

    </div>

</div>
