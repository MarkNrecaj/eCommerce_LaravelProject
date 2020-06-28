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
    public function list_orders()
    {
        $orders = Order::get();
        $users = User::get();
        return view('/admin/list_orders', compact('orders', 'users'));
    }

    public function showAllClients()
    {
        $clients = User::where('role_id', 3)->get();
        return view('admin/all_clients')->with('clients', $clients);
    }

    public function showAllWorkers()
    {
        $workers = User::where('role_id', 2)->get();
        //dd($workers);
        return view('all_workers')->with('workers', $workers);
    }

    public function disableAccount($id)
    {
        $user = User::find($id);
        $user->isActive = !$user->isActive;
        $user->save();

        return redirect()->route('clients')->with('success', $user->name . ' account ' . ($user->isActive ? 'enabled' : 'disabled') . ' successfully');
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
