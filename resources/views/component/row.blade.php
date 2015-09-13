<div class="component-row row">

    <div class="col-xs-2 col-sm-1 col-lg-offset-1 text-right">

        @if (isset($image_link)) <a href="{{ $image_link }}"> @endif

        @if (isset($image))
            
            @include('component.image', [
                'image' => $image,
                'options' => '-circle',
                'width' => isset($image_width) ? $image_width : null
            ])

        @endif
         
        @if (isset($image_link)) </a> @endif

    </div>

    @if (isset($extra))

        <div class="content col-xs-7 col-sm-10 col-lg-8">

    @else

        <div class="content col-xs-10 col-sm-11 col-lg-10">

    @endif

            <div class="title">

                @if (isset($heading_link)) <a href="{{ $heading_link }}"> @endif
            
                @if (isset($heading)) <h3>{{ $heading }}</h3> @endif

                @if (!isset($heading)) <p /> @endif

                @if (isset($heading_link)) </a> @endif

            </div>

            <div class="text">

                @if (isset($text)) {!! $text !!} @endif

                {!! $actions or '' !!}
            
            </div>

        </div>

    @if (isset($extra))

        <div class="col-xs-3 col-sm-1">

            {!! $extra !!}

        </div>

    @endif

</div>