<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class PostalClientsController extends Controller
{
    public function destroy($id)
    {
        // $registeredPostsByThisUser = Order::where('seller_id', $id)->get()->count();
        //dd($registeredPostsByThisUser);

        if (Order::where('seller_id', $id)->get()->count() > 0)
            return redirect('admin/clients')->with('error', 'Client has already registerred orders. Can\'t be deleted');

        $client = User::find($id);
        $client->delete();

        return redirect('admin/clients')->with('success', 'Client ' . $client->name . ' deleted successfuly');
    }
}
