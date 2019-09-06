@extends('layouts.app', ['activePage' => 'typography', 'titlePage' => __('Typography')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Material Dashboard Heading</h4>
        <p class="card-category">Created using Roboto Font Family</p>
      </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{route('add_posts')}}" class='btn btn-primary'>Adicionar</a>
                @if(!isset($post))
                    <br><br>
                    <div class="alert alert-danger">
                        <strong>Oops! 🤭 </strong> Not encontrado your produto.
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
