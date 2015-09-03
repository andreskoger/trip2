@foreach($users->chunk(6) as $chunk)

    <div class="row">

    @foreach($chunk as $user)

        <div class="col-xs-2 utils-padding-bottom">

            <a href="{{ route('user.show', [$user->user]) }}">
                
                @include('component.image', [
                    'image' => $user->user->preset('xsmall_square'),
                    'options' => '-circle'
                ])
            
            </a>

        </div>
        
    @endforeach

    </div>

@endforeach