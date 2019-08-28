@extends('layouts.app')

@section('content')
    <style>
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            opacity: 1;
            transition: opacity 0.6s;
            margin-bottom: 15px;
        }

        .alert.success {background-color: #4CAF50;}
        .alert.info {background-color: #2196F3;}
        .alert.warning {background-color: #ff9800;}

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
    @if (auth()->check())
        @if (auth()->user()->level == 4)
            <div class="container" align="center">
                <div class="row justify-content-center">

                    @if( $posts == '[]')

                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="title m-b-md">
                            <a>Posts</a>
                        </div>
                        @if(isset($bool))
                            <div class="alert success">
                                <span class="closebtn">&times;</span>
                                <strong>Sucesso!</strong> O seu comentario foi comentado comentariamente com sucesso!
                            </div>
                        @endif
                    </div>
                    <table  class="table table-bordered">
                        <thead >
                        <tr >
                            <th >Titulo</th>
                            <th>Mensage</th>
                            <th>Data</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        @foreach($posts as $post)

                            <form method="POST" action="{{route('posts.destroy', $post->id)}}">
                                @csrf
                                @method('DELETE')
                                <tbody>
                                <tr>
                                    <td>{{$post -> title}}</td>
                                    <td>{{$post -> message}}</td>
                                    <td>{{$post -> created_at}}</td>
                                    <td align="center">

                                        <a class="btn btn-primary" name ="" href="{{route('post_details', ['id_post'=>$post -> id, 'ut_post'=>$post -> idut])}}"> Ver details</a>

                                        <button class="btn btn-primary" name ="" type="sumit"> Delete</button>

                                    </td>
                                </tr>
                                </tbody></form>
                        @endforeach  </table>{{ $posts->links() }}</div>
                <div class="container" align="center"></div>
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
                        @if( $posts == '[]')

                        @endif
                        <div class="title m-b-md">
                            <a>Posts</a>
                        </div>
                        @if(isset($bool))
                            <div class="alert success">
                                <span class="closebtn">&times;</span>
                                <strong>Sucesso!</strong> O seu comentario foi comentado comentariamente com sucesso!
                            </div>
                        @endif
                    </div>


                    <table  class="table table-bordered">
                        <thead >
                        <tr >
                            <th >Titulo</th>
                            <th>Mensage</th>
                            <th>Data</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        @foreach($posts as $post)

                            <tbody>
                            <tr>
                                <td>{{$post -> title}}</td>
                                <td>{{$post -> message}}</td>
                                <td>{{$post -> created_at}}</td>
                                <td align="center">

                                    <a class="btn btn-primary" name ="" href="{{route('post_details', ['id_post'=>$post -> id, 'ut_post'=>$post -> idut])}}"> Ver details</a>
                                    <a class="btn btn-primary" name ="" href=""> Mensagem</a>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach  </table>{{ $posts->links() }}</div>

                <div class="container" align="center"></div>
            </div>
            </div>
        @endif
    @endif
@endsection
