@php

$header = $header ?? '';
$content = $content ?? collect();
$bottom = $bottom ?? collect();
$footer = $footer ?? '';

@endphp

@extends('v2.layouts.main')

@section('header', $header)

@section('content')

    <div class="container">

        <div class="row row-center padding-top-md padding-bottom-md">

            <div class="col-9">

                @foreach ($content->withoutLast() as $content_item)
                
                <div class="margin-bottom-md">

                    {!! $content_item !!}
                        
                </div>

                @endforeach

                <div>

                    {!! $content->last() !!}
                        
                </div>

            </div>

        </div>

    </div>

    <div class="container">

    @foreach ($bottom as $bottom_item)
    
        <div class="margin-bottom-md">

            {!! $bottom_item !!}
                
        </div>
            
    @endforeach

    </div>
    
@endsection

@section('footer', $footer)


