
@extends('layouts.appu')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            Faça o seu post
        </div>

        <div class="row justify-content-center">
            <div class="container">
                <div class="card">
                    <div class="card-header">{{ __('Suas Informações') }}</div>

                    <div class="card-body">

                        @if (auth()->check())
                            @if (auth()->user()->level == 4)



                            @else


                                @foreach ($post as $posts)

                                <form method="POST" action="{{ route('post.update', $posts->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Titulo') }}</label>

                                        <div class="col-md-6">
                                            <input id="title" type="text" value="{{$posts->title}}"  class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Titulo" required autocomplete="title" autofocus>

                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mensagem') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="text" type="text" value="{{$posts->message}}" class="form-control @error('text') is-invalid @enderror" name="text" value="{{$posts->message}}" required autocomplete="text">{{$posts->message}}</textarea>

                                            @error('text')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Editar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

