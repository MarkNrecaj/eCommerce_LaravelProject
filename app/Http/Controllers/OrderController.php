<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('seller_id', auth()->id())->get();
        return view('list_orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        if (!Auth::check())
            return redirect('/login');

        $this->validate(
            $request,
            [
                'receiver_name' => 'required|max:255',
                'receiver_tel' => 'required',
                'receiver_tel2' => 'nullable',
                'state' => 'required|max:255',
                'city' => 'required|max:255',
                'address' => 'nullable|max:255',
                'quantity' => 'required|numeric|min:1',
                'weight' => 'nullable|numeric|min:0',
                'order_type' => 'required|max:255',
                // 'is_openable' => 'required|boolean',
                // 'is_returnable' => 'required|boolean',
                'additional_notes' => 'nullable|max:255',
                'order_name' => 'required|max:255',
                'description' => 'nullable|max:255',
                'price' => 'required|numeric|gte:0',
            ]
        );

        if (
            strcasecmp($request['state'], 'Kosove') != 0 &&
            strcasecmp($request['state'], 'Albania') != 0 &&
            strcasecmp($request['state'], 'Maccedonia') != 0
        ) {
            return redirect('/order')->with('error', 'Me inspect element po don me haku a? -_-');
        }

        if (
            strcasecmp($request['order_type'], 'Normal') != 0 &&
            strcasecmp($request['order_type'], 'Fragile') != 0
        ) {
            return redirect('/order')->with('error', 'Me inspect element po don me haku a? -_-');
        }

        Order::create([
            'receiver_name' => $request['receiver_name'],
            'receiver_tel' => $request['receiver_tel'],
            'receiver_tel2' => $request['receiver_tel2'],
            'state' => $request['state'], //if shteti !=xk or al or mk !insert
            'city' => $request['city'],
            'address' => $request['address'],
            'quantity' => $request['quantity'],
            'weight' => $request['weight'],
            'order_type' => $request['order_type'],
            'is_openable' => $request->has('is_openable'), // $request['is_openable'],
            'is_returnable' => $request->has('is_returnable'), //['is_returnable'],
            'additional_notes' => $request['additional_notes'],
            'order_name' => $request['order_name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'status' => 'Processing',
            'seller_id' => Auth::user()->id,
            'total_price' => (float) $request['price'] * (int) $request['quantity'] + 2 //ku 2 eshte sherbimi postar 
        ]);

        //return redirect()->route('seller')->with('success', 'Order added successfully');
        return redirect()->back()->with('success', 'Order added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
