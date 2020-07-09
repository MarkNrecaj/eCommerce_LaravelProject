@extends('layouts.app')


@section('content')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cart</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($cart) > 0)
                        <table border="1px" style="width: 100%; text-align:justify; margin: 10px">
                            <tr>
                                <th style="text-align: justify;">Image</th>
                                <th style="text-align: justify;">Product name</th>
                                <th style="text-align: justify;">Price</th>
                                <th style="text-align: justify;">Amount </th>
                                <th style="text-align: justify;">Remove </th>
                            </tr>
                            @for ($i = 0; $i < count($cart); $i++)
                                
                                    <tr>
                                        <td><img style="align-text: center" width="100" height="100" src="../storage/images/{{$productsImage[$i][0]->path}}" /></td>
                                        <td style="min-width: 5px; max-width: 50px; padding:10px;">{{$products[$i]->name}}</td>
                                        <td style="padding: 10px">{{$products[$i]->price}}</td>
                                        <td style="padding: 10px">{{$cart[$i]->amount}}</td>
                                        <td style="padding: 10px"> 
                                            <form action="{{route('product.destroy',$cart[$i]->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <input type="submit" value="X" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                
                            @endfor    
                            
                        </table>

                        <a href="" class="btn btn-primary float-right">Buy all</a>
                    @else
                        <p>No products added to cart</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
