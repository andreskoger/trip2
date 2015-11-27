@foreach ($destinations as $key => $destination)

    @if (isset($destination->flaggable))

        <span class="c-user-destination__item">
            <a href="{{ route('destination.show', [$destination->flaggable]) }}" class="c-user-destination__item-link {{ $modifiers or '' }}">

                {{ $destination->flaggable->name }}

            </a>
        </span>

    @endif

@endforeach
