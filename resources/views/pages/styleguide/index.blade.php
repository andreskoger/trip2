@extends('layouts.main')

@section('title')

    Styleguide

@stop

@section('content')

<div class="component-styleguide">

<mark>Text paragraphs</mark>

<p>This book is a record of a pleasure trip. If it were a record of a solemn scientific expedition, it would have about it that gravity, that profundity, and that impressive incomprehensibility which are so proper to works of that kind, and withal so attractive.</p>

<p>Yet notwithstanding it is only a record of a <a href="https://en.wikipedia.org/wiki/Picnic">pic-nic</a>, it has a purpose, which is to suggest to the reader how he would be likely to see Europe and the East if he looked at them with his own eyes instead of the eyes of those who traveled in those countries  <em>before</em> him. I make small pretense of showing anyone how he ought to look at objects of interest beyond the sea — <strong>other books</strong> do that, and therefore, even if I were competent to do it, there is no need.</p>

<mark>Headings</mark>

<h2>Heading 2</h2>
Heading 2 is used in page titles

<h3>Heading 3</h3>
Heading 3 is used in item lists on pages

<h4>Heading 4</h4>
<p>Heading 4 is used for subheadings</p>

<mark>Menu</mark>

<p>Horizontal menus</p>

@include('component.menu', [
    'menu' => 'styleguide',
    'items' => [
        'first' => [
            'url' => ''
        ],
        'second' => [
            'url' => ''
        ],
        'third' => [
            'url' => ''
        ]
    ]
])

<br />

<mark>Actions</mark>

<p>Set of actions on content elements, usually for admins. Keep the labels short!</p>

@include('component.actions', [
    'actions' => [
        ['route' => '', 'title' => 'First'],
        ['route' => '', 'title' => 'Second'],
        ['route' => '', 'title' => 'Third']
    ]
])

<br />

<mark>Row component</mark>

<p>Row is meant for listings and content headers, it comes with different variations</p>

@foreach(['(none)', '-narrow', '-small', '-narrow -small'] as $options) 

<code>{{ $options }}</code>

@include('component.row', [
    'image' => \App\User::orderByRaw('RAND()')->first()->imagePreset(),
    'image_link' => '',
    'preheading' => 'Preheading',
    'heading' => 'Here comes the heading',
    'heading_link' => '',
    'postheading' => 'Postheading',
    'actions' => view('component.actions', [
        'actions' => [
            ['route' => '', 'title' => 'This is action'],
        ]
    ]),
    'text' => 'This is the subheading',
    'extra' => 'Extra',
    'body' => 'This book is a record of a pleasure trip. If it were a record of a solemn scientific expedition, it would have about it that gravity, that profundity, and that impressive incomprehensibility which are so proper to works of that kind, and withal so attractive.',
    'options' => $options
])

<br /><br />

@endforeach

<mark>Card component</mark>

<p>Any card properties can be combined. Cards fill proportionally their container width.</p>

<div class="row">
    
    @foreach(['(none)', '-center', '-noshade', '-noshade -invert'] as $options) 

    <div class="col-sm-3">
        
        <code>{{ $options }}</code>

        @include('component.card', [
            'image' => \App\Content::whereType('photo')
                ->orderByRaw('RAND()')
                ->first()
                ->imagePreset(),
            'title' => 'Here is title',
            'text' => 'Here is subtitle',
            'options' => $options,
        ])

    </div>

    @endforeach

</div>

<div class="row">
    
    @foreach(['-wide', '-square', '-portrait', '-rounded'] as $options) 

    <div class="col-sm-3">
        
        <code>{{ $options }}</code>

        @include('component.card', [
            'image' => \App\Content::whereType('photo')
                ->orderByRaw('RAND()')
                ->first()
                ->imagePreset(),
            'title' => 'Here is title',
            'text' => 'Here is subtitle',
            'options' => $options,
        ])

    </div>

    @endforeach

</div>


<mark>Icons</mark>

<br />

@foreach([
        'ticket', 'tent', 'sunglasses', 'plane', 'passport', 
        'mobile', 'lantern', 'compass', 'backpack'
    ] as $icon) 

    @include('component.icon', [
        'icon' => $icon,
    ])

@endforeach

<br />

@foreach(['wide1x1', 'wide2x1', 'narrow3x1', 'square4x1'] as $ad) 

    <mark>{{ ucfirst($ad) }} ad</mark>

    @include("component.ad.$ad")

@endforeach

</div>

@stop
