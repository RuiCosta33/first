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

                  @if(isset($prod))
                      @foreach($prod as $prods)
                          <form method='POST' action='{{route('market.destroy', $prods->id)}}' enctype="multipart/form-data" >
                              @csrf
                              @method('DELETE')
                              <tbody>
                              <tr>
                                  <td><img src="{{asset('img/photos/'.$prods->image)}}" width="50px" height="50px"></td>
                                  <td>{{$prods->name}}</td>
                                  <td>{{$prods->descricao}}</td>
                                  <td>{{$prods->preco}}</td>
                                  <td><a href="{{route('market_edit', $prods->id)}}" class='btn btn-primary'>Editar</a></td>
                                  <td><button type='submit' class='btn btn-primary'>Eliminar</button></td>
                              </tr>
                              </tbody>
                          </form>@endforeach @endif
              </table>
            </div>
          </div>
        </div>
      </div>

          </div>
        </div>
      </div>

@endsection
