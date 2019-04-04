@extends('layouts.app')

@section('content')

    @component('layouts.card')

    @slot('header')
        Create A New Mayday
    @endslot

    @livewire('mayday-create')

    @endcomponent

@endsection