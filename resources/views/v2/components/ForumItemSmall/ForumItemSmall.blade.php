@php

$profile = $profile ?? '';
$route = $route ?? '';
$title = $title ?? '';
$badge = $badge ?? '';

@endphp

<div class="ForumItemSmall {{ $isclasses }}">

	<div class="ForumItemSmall__profile">

    	{!! $profile !!}

    </div>

    <a href="{!! $route !!}">

	    <div class="ForumItemSmall__title">

	        {{ $title }}

	    </div>

        <div class="ForumItemSmall__meta">

            @foreach ($meta as $meta_item)

            {!! $meta_item !!}

            @endforeach

        </div>

    </a>

    <div class="ForumItemSmall__badge">

    {!! $badge !!}

    </div>

</div>