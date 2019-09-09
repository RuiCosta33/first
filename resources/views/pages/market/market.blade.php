@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')


    <style>
        .alert.success {background-color: #4CAF50;}
        .alert.info {background-color: #2196F3;}
        .alert.warning {background-color: #ff9800;}
    </style>
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
                @if(isset($_GET['ver']))

                    {{!$ver=$_GET['ver']}}

                    @if($ver=='nada')

                        <div class="alert warning">
                            <span class="closebtn">&times;</span>
                            <strong>Repetided Produto</strong> UI not amadorez jovem! 😎
                        </div>
                        @elseif($ver=='edit')
                        <div class="alert success">
                            <span class="closebtn">&times;</span>
                            <strong>Successoz!</strong> IU editate a produto! 👍
                        </div>
                    @elseif($ver=='del')
                        <div class="alert">
                            <span class="closebtn">&times;</span>
                            <strong>Apagated!</strong> IU jast apagate a produto! 👎
                        </div>
                        @else
                        <div class="alert info">
                            <span class="closebtn">&times;</span>
                            <strong>Adicionated!</strong> IU adissionat a produto! 🤙
                        </div>
                        @endif
                @endif
                    @if(isset($prod))
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
                                  <td><a href="{{route('market.edit', $prods->id)}}" class='btn btn-primary'>Editar</a></td>
                                  <td><button type='submit' class='btn btn-primary'>Eliminar</button></td>
                              </tr>
                              </tbody>
                          </form>@endforeach
                  @else
                      <div class="alert">
                          <span class="closebtn">&times;</span>
                          <strong>Not encontrado!</strong> IU jast pesquizate a produto not existente! 👎
                      </div>

                  @endif
              </table>
            </div>
          </div>
        </div>
      </div>

          </div>
        </div>
      </div>

@endsection
