@extends('layouts.appu')

@section('content')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .alert {
            padding: 15px;
            background-color: #f44336;
            color: white;
            height: 50px;
            width: 100%;
            align: center;
        }

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
            <div class="container" align="justify">
                <div class="title"  align="center">  Users </div>

              <br>



            <div class="container">


                <form action="/search" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" name="q"
                               placeholder="Search users"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
                    </div>
                </form>

                @if(isset($ver))
                    <br>
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong>ERROR!</strong> The user you tried to search was not found.
                    </div>
                @endif
                <br>
                <table  class="table table-bordered">
                    <thead >
                    <tr >
                        <th >Nome</th>
                        <th>Email</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
            @foreach($users as $user)


                <tbody>
                <tr>
                   <td>{{$user -> name}}</td>
                    <td>{{$user -> email}}</td>
                    <td align="center">

                        <a class="btn btn-primary" name ="{{$user -> id}}" href="{{route('edit_ad', $user -> id)}}"> Edit</a>
                        <a class="btn btn-primary"  name ="{{$user -> id}}" href="{{route('del', $user -> id)}}"> Delete</a>
                    </td>
                </tr>
                </tbody>{{ $users->links() }}
            @endforeach  </table></div>
                <div class="container" align="center"></div>

            @else
    <div class="container" align="justify">
                    <div class="title"  align="center">  Info</div>

                    <div class="col-md-12">
                        <h3>Nome - {{$details -> name}}</h3>
                        <h3>Email - {{$details -> email}}</h3>
                        <h3>Conta Criada em  - {{$details -> updated_at}}</h3>
                            <a class="btn btn-primary"href="{{route('edit')}}" >Editar Informação</a>
                            <a class="btn btn-primary"href="{{route('messages')}}" >Fazer um Post</a>
                            <a class="btn btn-primary"href="{{route('post_user')}}" >Ver meus posts</a>
                            <a class="btn btn-primary"href="{{route('us_post')}}" >Ver todos os posts</a>
                    </div>
    </div>

        @endif
    @endif
@endsection




