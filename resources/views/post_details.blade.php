@extends('layouts.appu')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0 auto;
            max-width: 100%;
            padding: 0 20px;
        }

        .container {
            font-size: 2vw;
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            margin: auto;
            max-width: 100%;
            padding: 0px;
        }
        .container_message {
            border-radius: 5px;
            margin: auto;
            max-width: 70%;
            padding: 10px;
        }
        .darker {
            font-size: 1.5vw;
            border-color: #ddd;
            background-color: #ddd;
            border-radius: 5px;
            max-width: 100%;
        }

        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .container img.right {
            float: right;
            margin-left: 20px;
            margin-right:0;
        }

        .time-right {
            float: right;
            color: #aaa;
        }
        .right{
            float: right;
        }

        .time-left {
            float: left;
            color: #999;
        }
    </style>
    @if (auth()->check())
        @if (auth()->user()->level == 4)
            <br><br><h1>Mensagem</h1>
                @foreach ($post as $posts)
                    @foreach($user as $users)
                                <div class="container darker">
                                    <h3><p>{{$users->name}} - {{$posts->title}}</p>
                                    <a>{{$posts->message}}</a></h3>
                                    <span class="time-right">{{$posts->created_at}}</span>
                                </div>
                                @if(isset($res))<h3 align="left">Respostas : <br>
                                    @foreach($res as $resp)
                                        @foreach($name as $names)

                                        <div class="darker">
                                            <p  style="width:100%;">{{$names->name}}</p>
                                            <p>{{$resp->respond}}</p>
                                            <span class="time-right">{{$resp->created_at}}</span>
                                        </div>


                                        <br>
                                        @endforeach
                                        @endforeach</h3>
                                    @endif

<br>
                            <form method="GET" action="{{ route('respond', [$users->id, $posts->id, $us_id=auth()->user()->id]) }}">
                                @csrf
                                @method('GET')
                                <div class="container_message form-group">

                                <textarea id="text" type="text" placeholder="Mensagem" class="form-control @error('text') is-invalid @enderror" name="text" value="{{ old('text') }}" required autocomplete="text"></textarea>
                                <br>
                                    <div class="form-group row mb-0" >
                                        <button type="submit" class="btn btn-primary">
                                            Publicar
                                        </button>
                                    </div>
                                </div>
                            </form>
            @endforeach
            @endforeach
        @else
<br><br>
            <div class="container" align="justify">
                @foreach ($post as $posts)
                    @foreach($user as $users)
                <div class="col-md-12">
                    <h3 align="center">Titulo - {{$posts -> title }}</h3>
                    <h3 align="center"> {{ $posts->message }}</h3><br>
                    <span class="time-right">{{$posts->created_at}}</span>
                </div></div><br>
                    @if(isset($res))<u><h3 align="left">Respostas : <br></h3></u>
                    @foreach($name as $names)
                        @foreach($res as $resp)<div  align="justify"><div class="col-md-12">

                                        <h3>
                                <div class="container darker">
                                    <b><p>{{$names->name}}</p></b>
                                    <p>{{$resp->respond}}</p>
                                    <span class="time-right">{{$resp->created_at}}</span>
                                </div>
                                        </h3>
                            </div></div>
                                <br>
                                @endforeach
                        @endforeach
                        @endif<div class="container" align="justify"><div class="col-md-12"><h3 align="left">
                    <h5 style="color: blue;">Responda a {{ $users->name }}</h5>
                    <form method="GET" action="{{ route('respond', [$users->id, $posts->id, $us_id=auth()->user()->id]) }}">
                        @csrf
                        @method('GET')

                    <textarea id="text" type="text" placeholder="Mensagem" class="form-control @error('text') is-invalid @enderror" name="text" value="{{ old('text') }}" required autocomplete="text"></textarea>
                    <br>
                        <div class="form-group row mb-0" align="right">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Responder
                                </button>
                            </div>
                        </div>
<br>
                    </form></h3>
                </div>
            </div>
            @endforeach
            @endforeach
        @endif
    @endif
@endsection
