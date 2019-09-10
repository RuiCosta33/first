@extends('layouts.appu')

@section('content')

    <style>
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    body {
        padding-top: 80px;
    }

    .show-cart li {
        display: flex;
    }
    .card {
        margin-bottom: 20px;
    }
    .card-img-top {
        width: 200px;
        height: 200px;
        align-self: center;
    }
</style>

<!-- Nav -->
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cart">Cart (<span class="total-count"></span>)</button><button class="clear-cart btn btn-danger">Clear Cart</button></div>
        </div>



<!-- Main -->
<div class="container">
    <div class="row">
        @foreach($prod as $prods)
        <div class="col">
            <div class="card" style="width: 20rem;">
                <img class="card-img-top" src="img/photos/{{ $prods->image}}" alt="Card image cap">
                <div class="card-block">
                    <h4 class="card-title">{{$prods->name}}</h4>
                    <p class="card-text">{{$prods->preco}}$</p>
                    <a href="#" data-name="Name" data-price="5" class="add-to-cart btn btn-primary">Add to cart</a>
                </div>
            </div>
        </div>

            @endforeach
    </div>
</div>

    <script type="text/javascript" src="{!! asset('js/market.min.js') !!}"></script>

<!-- Modal -->
    <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="show-cart table">

                    </table>
                    <div>Total price: $<span class="total-cart"></span></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Order now</button>
                </div>
            </div>
        </div>
    </div>



@endsection
