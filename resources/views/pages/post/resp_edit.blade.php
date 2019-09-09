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
                            <table class="table">
                                @if(isset($res))
                                    <thead class=" text-primary">
                                    <th>
                                        Resposta
                                    </th>
                                    </thead>

                                    @foreach($res as $resp)
                                        <form method='POST' action='{{route('respond.update', $resp->id)}}' enctype="multipart/form-data" >
                                            @csrf
                                            @method('PUT')
                                            <tbody>
                                            <tr>
                                                <td><input class='w3-input' placeholder='Kinder de Mel' type='text' name='respond' value='{{$resp->respond}}'></td>

                                                <td><button type='submit' class='btn btn-primary'>Editar</button></td>
                                            </tr>
                                            </tbody>
                                        </form>
                                    @endforeach
                                 @endif
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

