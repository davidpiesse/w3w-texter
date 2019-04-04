@extends('layouts.app')

@section('content')

    @component('layouts.card')

    @slot('header')
        Todos
    @endslot

    @livewire('todo-create')
    <br>
    @livewire('todo-delete')
    <br>
    @livewire('todo-list')

    @endcomponent




{{--      

    @component('layouts.card')

    @slot('header')
        Dashboard
    @endslot

    <a href="{{ route('mayday.create') }}" data-turbolinks-action="replace">Send SMS</a>
    @endcomponent

    @component('layouts.card')

    @slot('header')
        Open Cases
    @endslot
    <ul>
        @foreach(App\Mayday::all() as $mayday)
        <li> <a href="{{ route('mayday.track', $mayday) }}">{{ $mayday->id }}</a></li>
        @endforeach
    </ul>

    @endcomponent  --}}

@endsection