@extends('front-end.layouts.master')
@section('content')
<div class="container">
    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{session()->get('success_message')}}
        </div>
        @endif
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <div class="card shopping-cart">
             <div class="card-header bg-dark text-light">
                 <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                 Shipping cart
                 <div class="clearfix"></div>
             </div>
             <div class="card-body">
                 @if (Cart::count()>0)
                 <h5>{{ Cart::count()}} item(s) in shopping cart</h5>
                    @foreach (Cart::content() as $item)
                     <!-- PRODUCT -->
                     <div class="row">
                         <div class="col-12 col-sm-12 col-md-2 text-center">
                                 <img class="img-responsive" src="http://placehold.it/120x80" alt="prewiew" width="120" height="80">
                         </div>
                         <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                         <h4 class="product-name"><strong>{{ $item->name }}</strong></h4>
                             <h4>
                             <small>Product ID {{ $item->id }}</small>
                             </h4>
                         </div>
                         <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                             <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                 <h6><strong>{{ $item->price}}</h6>
                             </div>
                             {{-- <div class="col-4 col-sm-4 col-md-4">
                                 <div class="quantity">
                                     <input type="button" value="+" class="plus">
                                     <input type="number" step="1" max="99" min="1" value="1" title="Qty" class="qty"
                                            size="4">
                                     <input type="button" value="-" class="minus">
                                 </div>
                             </div> --}}
                             <div class="col-2 col-sm-2 col-md-2 text-right">
                             <form action="{{route('cart.destroy', $item->rowId)}}" method="POST">
                                @csrf
                                @method('delete')
                                 <button type="submit" class="btn btn-outline-danger btn-xs">
                                     <i class="fa fa-trash" aria-hidden="true"></i>
                                 </button>
                                </form>
                             </div>
                         </div>
                     </div>

                     @endforeach
                     @else
                     <h1>No item is selected for Shopping Cart</h1>
                 @endif
                     <!-- END PRODUCT -->
             </div>
             <div class="card-footer">

                 <div class="pull-right" style="margin: 10px">
                 <a href="{{route('checkout.index')}}" class="btn btn-success pull-right">Checkout</a>

                 </div>
             </div>
         </div>
 </div>
@endsection
