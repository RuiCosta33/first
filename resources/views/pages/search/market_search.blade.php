@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Market Table</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
                            <form action="/market_search" method="POST" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q"
                                           placeholder="Search products"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <i class="material-icons" height="1px">search</i>
            </button>
        </span>
                                </div>
                            </form>
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
                                            @foreach($details as $prod)
                                                <tr>
                                                    <td><img src="{{asset('img/photos/'.$prod->image)}}" width="50px" height="50px"></td>
                                                    <td>{{$prod->name}}</td>
                                                    <td>{{$prod->descricao}}</td>
                                                    <td>{{$prod->preco}}</td>
                                                    <td><a href="{{route('market.edit', $prod->id)}}" class='btn btn-primary'>Editar</a></td>
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
