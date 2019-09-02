@extends('layouts.appu')

@section('content')

    <style>
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            opacity: 1;
            transition: opacity 0.6s;
            margin-bottom: 15px;
        }

        .alert.success {background-color: #4CAF50;}
        .alert.info {background-color: #2196F3;}
        .alert.warning {background-color: #ff9800;}

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
        .puff{
            border:solid 1px black;
            float: left;
            max-width: 100%;
        }
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
    </style>

    @if (auth()->check())
        @if (auth()->user()->level == 4)


            <div class="container" align="center">
                <div class="row justify-content-center">
                    <div class="container" align="center"></div>
                    <h1>Market</h1>
                </div>
                @if(isset($erro))
                    <div class="alert">
                        <span class="closebtn">&times;</span>
                        <strong>ERROR !</strong> Oh sócio es uma merda, ja existe colega!
                    </div>
                @endif
                @if(isset($add))
                    <div class="alert success">
                        <span class="closebtn">&times;</span>
                        <strong>Boa Sócio!</strong> Diminui a grama que a malta ta a pedir. <span>NAO DES F5 CORNO</span>
                    </div>
            @endif
                <script>
                    const close = document.getElementsByClassName("closebtn");
                    let i;

                    for (i = 0; i < close.length; i++) {
                        close[i].onclick = function(){
                            var div = this.parentElement;
                            div.style.opacity = "0";
                            setTimeout(function(){ div.style.display = "none"; }, 600);
                        }
                    }
                </script>
                <div id="buttuns" >
                    <table>

                        <tr>
                            <td><div id="adicionar" ><button type="button" class="btn btn-primary "onclick="showHideDiv('adiciona')">Adicionar</button></div></td>
                            <td><div id="editar" ><button type="button" class="btn btn-primary "onclick="showHideDiv('edita')">Editar</button></div></td>
                            <td><div id="eliminar" ><button type="button" class="btn btn-primary "onclick="showHideDiv ('elimina')">Remover</button></div></td>

                        </tr>

                    </table>
                    </div><br>


                <div id='adiciona' style="display:none">

                    <table class='table table-striped col-md-12'>
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descricao</th>
                            <th>Imagem</th>
                            <th>Preco</th>
                            <th></th>
                        </tr>
                        </thead>
                            <form method='POST' action='{{route('market.store')}}' enctype="multipart/form-data" >
                                @csrf

                                <tbody>
                                    <tr>
                                        <td><input class='w3-input' placeholder=' Nome' type='text' name='nome' value=''></td>
                                        <td><input class='w3-input' placeholder=' Descricao' type='text' name='descricao' value=''></td>
                                        <td><input class='w3-input' type='file' name='image' accept="image/*"></td>
                                        <td><input class='w3-input' placeholder= 'Preco' type='number' name='preco' value='' step="0.01"></td>
                                        <td>
                                            <button type='submit' class='btn btn-primary'>Adicionar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </form>
                    </table>

                </div>



                <div id='edita' style="display:none">
                    <table class='table table-striped col-md-12'>
                        <thead>
                        <tr>
                            <th>Imagem</th>

                            <th>Nome</th>
                            <th>Descricao</th>
                            <th>Preco</th>
                            <th></th>
                        </tr>
                        </thead>
                        @if(isset($prod))
                            @foreach($prod as $prods)
                                <form method='POST' action='{{route('market.update', $prods->id)}}' enctype="multipart/form-data" >
                                    @csrf
                                    @method('PUT')
                                    <tbody>
                                    <tr>
                                        <td align="center"><img alt='{{$prods->image}}' src='img/photos/{{ $prods->image}}' height="55px" width="60px" align="center"></td>
                                        <td><input class='w3-input' placeholder='Kinder de Mel' type='text' name='nome' value='{{$prods->name}}'></td>
                                        <td><input class='w3-input' name='descricao' placeholder='Sabe a coco' type='text' value='{{$prods->descricao}}'></td>
                                        <td><input class='w3-input' placeholder= '4.20' type='text' name='preco' value='{{$prods->preco}}'></td>

                                        <td><button type='submit' class='btn btn-primary'>Editar</button></td>
                                    </tr>

                                </form>@endforeach @endif
                    </table>
                </div>

                <div id='elimina' style="display:none">
                    <table class='table table-striped col-md-12'>
                        <thead>
                        <tr><th>Image</th>
                            <th>Nome</th>
                            <th>Descricao</th>
                            <th>Preco</th>
                            <th></th>
                        </tr>
                        </thead>
                        @if(isset($prod))
                        @foreach($prod as $prods)
                        <form method='POST' action='{{route('market.destroy', $prods->id)}}'>
                            @csrf
                            @method('DELETE')
                            <tbody>
                            <tr>


                                <td align="center"><img alt='{{$prods->image}}' src='img/photos/{{ $prods->image}}' height="55px" width="60px" align="center"></td>
                                <td> <a class='w3-input' placeholder='Kinder de Mel' type='text' name='nome'>{{$prods->name}}</a></td>
                                <td><a class='w3-input' placeholder='Sabe a coco' type='text' name='descricao'>{{$prods->descricao}}</a></td>
                                <td><a class='w3-input' placeholder= '4.20' type='text' name='preco' >{{$prods->preco}}</a></td>
                                <td>
                                    <button type='submit' class='btn btn-primary'>Eliminar</button>
                                </td>
                            </tr>

                        </form>@endforeach @endif
                    </table>
                </div>


            </div>

        @else
<style>
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
@if(isset($prod))
<!-- Nav -->
<nav class="navbar bg-inverse fixed-top bg-faded">
    <div class="row">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cart">Cart (<span class="total-count"></span>)</button><button class="clear-cart btn btn-danger">Clear Cart</button>
    </div>
</nav>


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
                    <a href="#" data-name="{{$prods->name}}" data-price="{{$prods->preco}}" class="add-to-cart btn btn-primary">Add to cart</a>
                </div>
            </div>
        </div>
            @endforeach
    </div>
</div>
@endif

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

<script>
    // ************************************************
    // Shopping Cart API
    // ************************************************

    var shoppingCart = (function() {
        // =============================
        // Private methods and propeties
        // =============================
        cart = [];

        // Constructor
        function Item(name, price, count) {
            this.name = name;
            this.price = price;
            this.count = count;
        }

        // Save cart
        function saveCart() {
            sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
        }

        // Load cart
        function loadCart() {
            cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
        }
        if (sessionStorage.getItem("shoppingCart") != null) {
            loadCart();
        }


        // =============================
        // Public methods and propeties
        // =============================
        var obj = {};

        // Add to cart
        obj.addItemToCart = function(name, price, count) {
            for(var item in cart) {
                if(cart[item].name === name) {
                    cart[item].count ++;
                    saveCart();
                    return;
                }
            }
            var item = new Item(name, price, count);
            cart.push(item);
            saveCart();
        }
        // Set count from item
        obj.setCountForItem = function(name, count) {
            for(var i in cart) {
                if (cart[i].name === name) {
                    cart[i].count = count;
                    break;
                }
            }
        };
        // Remove item from cart
        obj.removeItemFromCart = function(name) {
            for(var item in cart) {
                if(cart[item].name === name) {
                    cart[item].count --;
                    if(cart[item].count === 0) {
                        cart.splice(item, 1);
                    }
                    break;
                }
            }
            saveCart();
        }

        // Remove all items from cart
        obj.removeItemFromCartAll = function(name) {
            for(var item in cart) {
                if(cart[item].name === name) {
                    cart.splice(item, 1);
                    break;
                }
            }
            saveCart();
        }

        // Clear cart
        obj.clearCart = function() {
            cart = [];
            saveCart();
        }

        // Count cart
        obj.totalCount = function() {
            var totalCount = 0;
            for(var item in cart) {
                totalCount += cart[item].count;
            }
            return totalCount;
        }

        // Total cart
        obj.totalCart = function() {
            var totalCart = 0;
            for(var item in cart) {
                totalCart += cart[item].price * cart[item].count;
            }
            return Number(totalCart.toFixed(2));
        }

        // List cart
        obj.listCart = function() {
            var cartCopy = [];
            for(i in cart) {
                item = cart[i];
                itemCopy = {};
                for(p in item) {
                    itemCopy[p] = item[p];

                }
                itemCopy.total = Number(item.price * item.count).toFixed(2);
                cartCopy.push(itemCopy)
            }
            return cartCopy;
        }

        // cart : Array
        // Item : Object/Class
        // addItemToCart : Function
        // removeItemFromCart : Function
        // removeItemFromCartAll : Function
        // clearCart : Function
        // countCart : Function
        // totalCart : Function
        // listCart : Function
        // saveCart : Function
        // loadCart : Function
        return obj;
    })();


    // *****************************************
    // Triggers / Events
    // *****************************************
    // Add item
    $('.add-to-cart').click(function(event) {
        event.preventDefault();
        var name = $(this).data('name');
        var price = Number($(this).data('price'));
        shoppingCart.addItemToCart(name, price, 1);
        displayCart();
    });

    // Clear items
    $('.clear-cart').click(function() {
        shoppingCart.clearCart();
        displayCart();
    });


    function displayCart() {
        var cartArray = shoppingCart.listCart();
        var output = "";
        for(var i in cartArray) {
            output += "<tr>"
                + "<td>" + cartArray[i].name + "</td>"
                + "<td>" + cartArray[i].price + "$</td>"
                + "<td><div class='input-group' ><button class='minus-item btn btn-primary' data-name=" + cartArray[i].name + ">-</button><button class='plus-item btn btn-primary ' data-name=" + cartArray[i].name + ">+</button>"
                + "<td><input type='number' class='item-count form-control' width='15%' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'></td>"
                + "</div></td>"
                + "<td><button class='delete-item btn btn-danger' data-name=" + cartArray[i].name + ">X</button></td>"
                + " = "
                + "<td>" + cartArray[i].total + "$</td>"
                +  "</tr>";
        }
        $('.show-cart').html(output);
        $('.total-cart').html(shoppingCart.totalCart());
        $('.total-count').html(shoppingCart.totalCount());
    }

    // Delete item button

    $('.show-cart').on("click", ".delete-item", function(event) {
        var name = $(this).data('name')
        shoppingCart.removeItemFromCartAll(name);
        displayCart();
    })


    // -1
    $('.show-cart').on("click", ".minus-item", function(event) {
        var name = $(this).data('name')
        shoppingCart.removeItemFromCart(name);
        displayCart();
    })
    // +1
    $('.show-cart').on("click", ".plus-item", function(event) {
        var name = $(this).data('name')
        shoppingCart.addItemToCart(name);
        displayCart();
    })

    // Item count input
    $('.show-cart').on("change", ".item-count", function(event) {
        var name = $(this).data('name');
        var count = Number($(this).val());
        shoppingCart.setCountForItem(name, count);
        displayCart();
    });

    displayCart();

</script>

        @endif
    @endif
@endsection
