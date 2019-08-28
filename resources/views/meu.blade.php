@extends('layouts.app')

@section('content')

    @if (auth()->check())
        @if (auth()->user()->level == 4)
            <div class="container" align="center">
                <div class="row justify-content-center">


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="title m-b-md">
                            Bem vindo - <a> {{$user->name}}</a><br>
                            <a class="btn btn-primary" href="{{route('details')}}">Utilizadores</a>
                            <a class="btn btn-primary" href="{{route('us_post')}}">Posts</a>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="container" align="center">
                <div class="row justify-content-center">


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="title m-b-md">
                            Bem vindo - <a href="{{route('details')}}"> {{$user->name}}</a>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    @endif
@endsection


