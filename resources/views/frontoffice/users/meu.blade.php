@extends('layouts.appu')

@section('content')


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
@endsection


