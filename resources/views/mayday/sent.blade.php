@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sent</div>

                <div class="card-body">
                    {{--  Livewire  --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{--  Livewire  --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p>The Mayday message has been sent</p>
                    {{--  Livewire  --}}
                    <a href="{{ route('mayday.track', $mayday) }}">Track</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
