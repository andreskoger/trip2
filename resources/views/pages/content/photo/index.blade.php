@extends('layouts.main')

@section('title')
    {{ trans("content.$type.index.title") }}
@stop

@section('header.right')
    @include('component.button', [ 
        'route' => route('content.create', ['type' => $type]),
        'title' => trans("content.$type.create.title")
    ])
@stop

@section('content')

    <div class="utils-border-bottom">

        @include('component.filter')

    </div>

    @foreach ($contents as $content)

        <div class="utils-double-border-bottom">

            <div class="row utils-padding-bottom">

                <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">

                    <div class="utils-padding-bottom">

                    <a href="{{ route('content.show', [$content->type, $content]) }}">
                        
                        <img src="{{ $content->images()->first()->preset('large') }}" />
                    
                    </a>

                    </div>

                </div>

            </div>

            <div class="row utils-padding-bottom">

                <div class="col-sm-10 col-sm-offset-1">

            @include('component.row', [
                'image' => $content->user->preset('xsmall_square'),
                'image_link' => route('user.show', [$content->user]),
                'heading' => $content->title,
                'text' => trans("content.show.row.text", [
                    'user' => view('component.user.link', ['user' => $content->user]),
                    'created_at' => $content->created_at->format('d. m Y H:i:s'),
                    'updated_at' => $content->updated_at->format('d. m Y H:i:s'),
                    'destinations' => $content->destinations->implode('name', ','),
                    'tags' => $content->topics->implode('name', ','),
                ]),
            ])

                </div>

            </div>

            <div class="row">

                <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">

                {!! $content->body_filtered !!}

                @include('component.comment.index', ['comments' => $content->comments])

                </div>

            </div>

        </div>

    @endforeach


    {!! $contents->render() !!}

@stop

