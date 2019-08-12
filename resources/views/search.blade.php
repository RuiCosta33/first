@extends('layouts.app')

@section('content')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


    @if (auth()->check())
        @if (auth()->user()->level == 4)

            <div class="title"  align="center">  Search</div> <br>

            <div class="container">
                <form action="/search" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" name="q"
                               placeholder="Search users"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button><a class="btn btn-primary" name ="" href="{{route('details')}}" align="right"> Cancel</a>
        </span>
                    </div>
                </form>

                <br>
                @if(isset($details))
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td >

                                    <a class="btn btn-primary" name ="{{$user -> id}}" href="{{route('edit_ad', $user -> id)}}"> Edit</a>
                                    <a class="btn btn-primary" name ="{{$user -> id}}" href="{{route('del', $user -> id)}}"> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        @endif
    @endif
@endsection
