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
                                <thead class=" text-primary">
                                <th>
                                    Post
                                </th>
                                </thead>
                                    <form method='POST' action='{{route('post.create')}}' enctype="multipart/form-data" >
                                        @csrf
                                        @method('GET')
                                        <tbody>
                                        <tr>
                                            <td><input class='w3-input' placeholder='Title' type='text' name='title' ></td>
                                            <td><input class='w3-input' placeholder='Message' type='text' name='message' ></td>
                                            <td><button type='submit' class='btn btn-primary'>Adicionar</button></td>
                                        </tr>
                                        </tbody>
                                    </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

