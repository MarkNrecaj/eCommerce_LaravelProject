<?php

namespace App\Http\Controllers;

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
        return view('checkout')->with(compact('products'));
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
        dd($request->all());

        $this->validate(
            $request,
            [   'name' => 'required',
                'email'=> 'required|email',
                'state' => 'required',
                'city' => 'required',
                'address' => 'nullable'
            ]
        );

        try {
            $stripe = Stripe::make('sk_test_51H0mlKK5oDGBuQ7Kkgj6KVsIowcTCS99NPDtO00r3Y011Xa2GShmBkotvPkXDKVW4H7yjpAIo0rFnDeGflrDulHr00ukWffyBZ');
            $change = $stripe->charges()->create([
                'amount' => 100, //E merr vleren prej cart
                'currency' => 'EUR',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metatadata' => [],
            ]);

            return view('checkout')->with('success_message',"Thank you! Your payment has been successfully accepted");

        } catch (CardErrorException $e) {
            return view('checkout')->withErrors('Error!', $e->getMessage());
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
        //
    }
}
