@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">ASDAS Table</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
                        </div>

 @if(isset($details))
                        <div class="card-body">
                            <div class="table-responsive">
                                <a href="{{route('add_prod')}}" class='btn btn-primary'>Adicionar</a>
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


                                        <br>

                                                <tbody>
                                                @foreach($details as $user)
                                                    <tr>
                                                        <td><img src="{{asset('img/photos/'.$user->image)}}" width="50px" height="50px"></td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->descricao}}</td>
                                                        <td>{{$user->preco}}</td>
                                                        <td><a href="{{route('market_edit', $user->id)}}" class='btn btn-primary'>Editar</a></td>
                                                        <td><button type='submit' class='btn btn-primary'>Eliminar</button></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                        @endif
                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection





