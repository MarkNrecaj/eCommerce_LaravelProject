<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin');
    }

    /**
     * List of orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_new_orders()
    {
        $orders = Order::where('poster_id', null)->orderBy('created_at', 'DESC')->get();
        $users = User::get();
        return view('/admin/list_new_orders', compact('orders', 'users'));
    }

    public function list_orders()
    {
        $orders = Order::whereNotNull('poster_id')->where('status', '<>', 'delivered')->orderBy('created_at', 'DESC')->get();
        $users = User::get();
        return view('/admin/list_orders', compact('orders', 'users'));
    }

    public function list_delivered_orders()
    {
        $orders = Order::where('status', 'delivered')->orderBy('created_at', 'DESC')->get();
        $users = User::get();
        return view('/admin/list_delivered_orders', compact('orders', 'users'));
    }

    public function post_settings()
    {
        return view('/admin/post_settings');
    }

    public function showAllClients()
    {
        $clients = User::where('role_id', 3)->get();
        return view('admin/all_clients')->with('clients', $clients);
    }

    public function disableAccount(User $id)
    {
        $id->isActive = !$id->isActive;
        $id->save();

        return redirect('admin/clients')->with('success', 'Changes saved successfully');
    }

    public function showAllWorkers()
    {
        $workers = User::where('role_id', 2)->get();
        //dd($workers);
        return view('all_workers')->with('workers', $workers);
    }

    public function showOrder($id)
    {
        $order = Order::find($id);
        $users = User::get();
        return view('admin.view_orders', compact('order', 'users'));
    }

    public function showDeliveredOrder($id)
    {
        $order = Order::find($id);
        $users = User::get();
        return view('admin.view_delivered_orders', compact('order', 'users'));
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
        //
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
