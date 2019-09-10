@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
    <style>
        .pesquisa {
            border: 2px solid purple;
            border-radius: 5px;
        }
    </style>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary ">
                            <h4 class="card-title ">Everything Table</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
                        </div>
                        @if(isset($prod) or isset($post) or isset($users))
                            @if(isset($post) and $post!='[]')
                                <div class="pesquisa">
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
                                            <form method='POST' action='{{route('post.destroy', $posts->id)}}'
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <tbody>
                                                <tr>
                                                    <td>{{$posts->title}}</td>
                                                    <td>{{$posts->message}}</td>
                                                    <td><a href="{{route('post_edit', $posts->id)}}"
                                                           class='btn btn-primary'>Editar</a></td>
                                                    <td><a href="{{route('respond.show', $posts->id)}}"
                                                           class='btn btn-primary'>Ver respostas</a></td>
                                                    <td>
                                                        <button type='submit' class='btn btn-primary'>Eliminar</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </form>@endforeach
                                    </table>
                                </div>
                            @endif
                            @if(isset($prod) and $prod!='[]')
                                <div class="pesquisa">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class=" text-primary">
                                                <th>
                                                    Image
                                                </th>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Descricao
                                                </th>
                                                <th>
                                                    Preco
                                                </th>
                                                <th>
                                                    Editar
                                                </th>
                                                <th>
                                                    Eliminar
                                                </th>
                                                </thead>
                                                <div class="container">
                                                    <tbody>
                                                    @foreach($prod as $prods)
                                                        <tr>
                                                            <td><img src="{{asset('img/photos/'.$prods->image)}}"
                                                                     width="50px" height="50px"></td>
                                                            <td>{{$prods->name}}</td>
                                                            <td>{{$prods->descricao}}</td>
                                                            <td>{{$prods->preco}}</td>
                                                            <td><a href="{{route('market.edit', $prods->id)}}"
                                                                   class='btn btn-primary'>Editar</a></td>
                                                            <td>
                                                                <button type='submit' class='btn btn-primary'>Eliminar
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </div>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(isset($users) and $users!='[]')
                                <div class="pesquisa">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>
                                            {{ __('Name') }}
                                        </th>
                                        <th>
                                            {{ __('Email') }}
                                        </th>
                                        <th>
                                            {{ __('Creation date') }}
                                        </th>
                                        <th class="text-right">
                                            {{ __('Actions') }}
                                        </th>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    {{ $user->created_at->format('Y-m-d') }}
                                                </td>
                                                <td class="td-actions text-right">
                                                    @if ($user->id != auth()->id())
                                                        <form action="{{ route('user.destroy', $user) }}" method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <a rel="tooltip" class="btn btn-success btn-link"
                                                               href="{{ route('user.edit', $user) }}"
                                                               data-original-title="" title="">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                            <button type="button" class="btn btn-danger btn-link"
                                                                    data-original-title="" title=""
                                                                    onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">close</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a rel="tooltip" class="btn btn-success btn-link"
                                                           href="{{ route('profile.edit') }}" data-original-title=""
                                                           title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                    </div>

@endsection





