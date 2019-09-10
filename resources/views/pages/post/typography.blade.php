@extends('layouts.app', ['activePage' => 'typography', 'titlePage' => __('Typography')])

@section('content')
    <style>
        .alert.success {background-color: #4CAF50;}
        .alert.info {background-color: #2196F3;}
        .alert.warning {background-color: #ff9800;}
    </style>
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Material Dashboard Heading</h4>
        <p class="card-category">Created using Roboto Font Family</p>
          <form action="/post_search" method="POST" role="search">
              {{ csrf_field() }}
              <div class="input-group">
                  <input type="text" class="form-control" name="q"
                         placeholder="Search Posts"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <i class="material-icons" height="1px">search</i>
            </button>
        </span>
              </div>
          </form>
      </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{route('add_posts')}}" class='btn btn-primary'>Adicionar</a>
                    @if(isset($_GET['ver']))

                    {{!$ver=$_GET['ver']}}

                    @if($ver=='nada')

                        <div class="alert warning">
                            <span class="closebtn">&times;</span>
                            <strong>Repetided Post</strong> UI not amadorez jovem! 😎
                        </div>
                    @elseif($ver=='edit')
                        <div class="alert success">
                            <span class="closebtn">&times;</span>
                            <strong>Successoz!</strong> IU editate a post! 👍
                        </div>
                    @elseif($ver=='del')
                        <div class="alert">
                            <span class="closebtn">&times;</span>
                            <strong>Apagated!</strong> IU jast apagate a post! 👎
                        </div>
                    @else
                        <div class="alert info">
                            <span class="closebtn">&times;</span>
                            <strong>Adicionated!</strong> IU adissionat a post! 🤙
                        </div>
                    @endif
                @endif
                @if(isset($_GET['verr']))

                    {{!$ver=$_GET['verr']}}

                    @if($ver=='nada')

                        <div class="alert warning">
                            <span class="closebtn">&times;</span>
                            <strong>Repetided Resposta</strong> UI not amadorez jovem! 😎
                        </div>
                    @elseif($ver=='edit')
                        <div class="alert success">
                            <span class="closebtn">&times;</span>
                            <strong>Successoz!</strong> IU editate a resposta! 👍
                        </div>
                    @elseif($ver=='del')
                        <div class="alert">
                            <span class="closebtn">&times;</span>
                            <strong>Apagated!</strong> IU jast apagate a resposta! 👎
                        </div>
                    @else
                        <div class="alert info">
                            <span class="closebtn">&times;</span>
                            <strong>Adicionated!</strong> IU adissionat a resposta! 🤙
                        </div>
                    @endif
                @endif
                @if(!isset($post))
                    <br><br>
                    <div class="alert alert-danger">
                        <strong>Oops! 🤭 </strong> Not encontrado your post.
                    </div>
                @endif
                @if(isset($post))
                    <table class="table">
                        <thead class=" text-primary">
                        <th>
                            Title
                        </th>
                        <th>
                            Message
                        </th>
                        <th>
                            Editar
                        </th>
                        <th>
                            Respostas
                        </th>
                        <th>
                            Eliminar
                        </th>
                        </thead>



                        @foreach($post as $posts)
                            <form method='POST' action='{{route('post.destroy', $posts->id)}}' enctype="multipart/form-data" >
                                @csrf
                                @method('DELETE')
                                <tbody>
                                <tr>
                                    <td>{{$posts->title}}</td>
                                    <td>{{$posts->message}}</td>
                                    <td><a href="{{route('post_edit', $posts->id)}}" class='btn btn-primary'>Editar</a></td>
                                    <td><a href="{{route('respond.show', $posts->id)}}" class='btn btn-primary'>Ver respostas</a></td>
                                    <td><button type='submit' class='btn btn-primary'>Eliminar</button></td>
                                </tr>
                                </tbody>
                            </form>@endforeach
                    </table> @endif
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
