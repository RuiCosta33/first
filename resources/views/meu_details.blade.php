@extends('layouts.app')

@section('content')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    @if (auth()->check())
        @if (auth()->user()->level == 4)
            <div class="container" align="justify">
                <div class="title"  align="center">  Info</div>

              <br>
            <div class="container">
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
                        <a class="btn btn-primary" name ="{{$user -> id}}" href="{{route('del', $user -> id)}}"> Delete</a>
                    </td>
                </tr>
                </tbody>

            @endforeach </table></div>
            @else
    <div class="container" align="justify">
                    <div class="title"  align="center">  Info</div>

                    <div class="col-md-12">
                        <h3>Nome - {{$details -> name}}</h3>
                        <h3>Email - {{$details -> email}}</h3>
                        <h3>Conta Criada em  - {{$details -> updated_at}}</h3>
                            <a class="btn btn-primary"href="{{route('edit')}}" >Editar Informação</a>
                    </div>
    </div>
        @endif
    @endif
@endsection




