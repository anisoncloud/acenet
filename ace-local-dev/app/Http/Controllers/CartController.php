<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$productName = $request->productName;
        //$productPrice = $request->productPrice;
        //$productOtc = $request->delivery;

        //return view('front-end.cart');
       // return view('front-end.checkout');
    }

    public function tonewpage(Request $request)
    {
        $productOtc = 12000;
        Session::put('productName', $request->productName);
        Session::put('productPrice', $request->productPrice);
        Session::put('productOtc', $productOtc);
        $totalCost = Session::get('productPrice')+$productOtc;
        Session::put('totalCost', $totalCost);
        $customer =array(
            'billing_name'          =>      '',
            'billing_phone'            =>      '',
            'billing_email'             =>      '',
            'billing_nid'               =>      '',
            'billing_gender'             =>      '',
            'billing_apartment'         =>      '',
            'billing_house'             =>      '',
            'billing_road'              =>      '',
            'billing_block'             =>      '',
            'billing_area'              =>      '',
            'billing_city'              =>      '',
            'billing_pcode'             =>      '',
            'billing_zone'              =>      '',
            'billing_cdate'             =>      '',
            'billing_note'              =>      '',
            'billing_splan'             =>      '',
        );
        return view('front-end.checkout')->with('customer', $customer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Cart::count()>=1) {
            Cart::destroy();
        }

            //dd(Cart::count());
        /* $duplicats = Cart::search(function($cartItem, $rowId) use($request){
            return $cartItem->id ===$request->id;
        }); */

        /* if ($duplicats->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your Cart');
        } */

        if($request->id==1){
            $productName = 'Mega';
            $productPrice = 4000;
        }
        if($request->id==2){
            $productName = 'Giga';
            $productPrice = 7000;
        }
        if($request->id==3){
            $productName = 'Pico';
            $productPrice = 1600;
        }
        if($request->id==4){
            $productName = 'Nano';
            $productPrice = 2500;
        }
        if($request->id==5){
            $productName = 'Diamond';
            $productPrice = 5000;
        }
        if($request->id==6){
            $productName = 'Ruby';
            $productPrice = 9000;
        }
        if($request->id==7){
            $productName = 'Sapphire';
            $productPrice = 16000;
        }

        $delivery = 8000;

        //Cart::add($request->id, $productName, 1, $productPrice, $delivery);
        Cart::add([
            'id'=>$request->id,
            'name'=>$productName,
            'qty'=>1,
            'price'=>$productPrice,
            'weight'=>1,
            'options'=>[
                'delivery'=>$delivery,
                'totalPrice'=>$productPrice+$delivery
                ]
        ]);
        //dd(request()->all());
        //return redirect()->route('cart.index')->with('success_message', 'Product Added to card');
        //dd(Cart::content());
        return view('front-end.select-customer', ['productName'=>$productName, 'productPrice'=>$productPrice, 'delivery'=>$delivery]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success_message', 'Item has been removed');
    }
}
