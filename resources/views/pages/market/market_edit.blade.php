@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Simple Table</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
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
                                        Function
                                    </th>
                                    </thead>
                                    @foreach($prod as $prods)
                                    <form method='POST' action='{{route('market.update', $prods->id)}}' enctype="multipart/form-data" >
                                        @csrf
@method('PUT')
                                        <tbody>
                                        <tr>
                                            <td><input class='w3-input' value='{{$prods->name}}' type='text' name='nome' value=''></td>
                                            <td><input class='w3-input'  value='{{$prods->descricao}}' type='text' name='descricao' value=''></td>
                                            <td><input class='w3-input'  value='{{$prods->preco}}' type='number' name='preco' value='' step="0.01"></td>
                                            <td>
                                                <button type='submit' class='btn btn-primary'>Adicionar</button>
                                            </td>
                                        </tr>
                                        </tbody>

                                    </form> @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

