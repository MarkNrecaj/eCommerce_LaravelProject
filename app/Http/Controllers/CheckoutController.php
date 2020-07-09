<?php

namespace App\Http\Controllers;

use App\PostalSetting;
use App\Product;
use App\ProductImage;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all(); //Duhet mi marr produktet prej Cart
        $transfer_fee = PostalSetting::find(1)->transfer_fee;
        $total_price = $transfer_fee;
        foreach ($products as $product){
            $total_price = $total_price + $product->price;
        }
        return view('checkout/checkout')->with(compact('products','total_price','transfer_fee'));
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
        //dd($request->all());

        $this->validate(
            $request,
            [   'name' => 'required',
                'email'=> 'required|email',
                'state' => 'required',
                'city' => 'required',
                'address' => 'nullable'
            ]
        );

        $transfer_fee = PostalSetting::find(1)->transfer_fee;
        $products = Product::all(); //Duhet mi marr produktet prej Cart
        $total_price = $transfer_fee;
        foreach ($products as $product){
            $total_price = $total_price + $product->price;
        }

        try {
            $stripe = Stripe::make('sk_test_51H0mlKK5oDGBuQ7Kkgj6KVsIowcTCS99NPDtO00r3Y011Xa2GShmBkotvPkXDKVW4H7yjpAIo0rFnDeGflrDulHr00ukWffyBZ');
            $change = $stripe->charges()->create([
                'amount' => $total_price, //E merr vleren prej cart
                'currency' => 'EUR',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metatadata' => [],
            ]);

            return view('checkout/checkout')->with(compact('products','total_price','transfer_fee'));

        } catch (CardErrorException $e) {
            return view('checkout/checkout')->withErrors(compact('products','total_price','transfer_fee'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $products = Product::where('id', $id)->get();
//        //dd($product);
//        $total_price = 2;
//        foreach ($products as $product){
//            $total_price = $total_price + $product->price;
//        }
//        return view('checkout/checkout')->with(compact('products','total_price'));
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
        //
    }
}
