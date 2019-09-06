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
                                        </tr>



                                        </tbody>
                                    </form>@endforeach
                            </table>
                        <table class="table">
                            @if(isset($res))
                            <thead class=" text-primary">
                            <th>
                                Respostas
                            </th>
                            </thead>
                            @foreach($res as $resp)
                                    <form method='POST' action='{{route('respond.destroy', $resp->id)}}' enctype="multipart/form-data" >
                                        @csrf
                                        @method('DELETE')
                            <tbody>
                                <tr style="background: grey;">
                                    <td>{{$resp->respond}}</td>
                                    <td><a href="{{route('respond.edit', $resp->id)}}" class='btn btn-primary'>Editar</a></td>
                                    <td><button type='submit' class='btn btn-primary'>Eliminar</button></td>
                                </tr>
                            </tbody>
                                    </form>
                            @endforeach
                            @endif
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
