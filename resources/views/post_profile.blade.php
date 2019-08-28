@extends('layouts.app')

@section('content')

    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    @if (auth()->check())
        @if (auth()->user()->level == 4)

        @else
            <br><br>
            <div class="container" align="justify">

                    @if( $post == '[]')
                        <h3>Nao tem nenhum post!</h3>
                        @else


                        @csrf
                        @method('DELETE')
                        <table class="table table-striped col-md-12">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                            @foreach($post as $posts)


                                <form method="POST" action="{{route('posts.destroy', $posts->id)}}">
                        <tbody>
                        <tr>
                            <td>{{$posts->title}}</td>
                            <td>{{$posts->message}}</td>
                            <td>


                                   <a  class="btn btn-primary" href="{{route('postform', $posts->id)}}">Edit</a>
                                <a class="btn btn-primary" name ="" href="{{route('post_details', ['id_post'=>$posts -> id, 'ut_post'=>$posts -> idut])}}"> Ver respostas</a>
                                    <button type="submit" class="btn btn-primary">Delete</button>

                            </td>
                        </tr>
                        </tbody> @endforeach
                            @endif
                    </table></form>



                        </div>@endif

    @endif
@endsection
