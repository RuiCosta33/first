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
                        <a href="{{route('add_prod')}}" class='btn btn-primary'>Adicionar</a>
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



                                @if(isset($post))
                                    @foreach($post as $posts)
                                        <form method='POST' action='{{route('post.update', $posts->id)}}' enctype="multipart/form-data" >
                                            @csrf
                                            @method('PUT')
                                            <tbody>
                                            <tr>
                                                <td><input class='w3-input' placeholder='Kinder de Mel' type='text' name='title' value='{{$posts->title}}'></td>
                                                <td><input class='w3-input' name='text' placeholder='Sabe a coco' type='text' value='{{$posts->message}}'></td>

                                                <td><button type='submit' class='btn btn-primary'>Editar</button></td>
                                            </tr>
                                            </tbody>
                                        </form>@endforeach @endif
                            </table>@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

