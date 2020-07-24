@extends('layouts.app')
@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection
@section('content')
<div class="col-md-4 mx-auto custom-container">
    <h4 class="text-center">Track Your Order</h4>
    <form class="custom-form " action="{{route('order.track')}}" method="post">
        @csrf
        <br>
        <div class="mb-3">
            <input id="buyerPhone" type="number"  min="0" class="form-control" name="buyerPhone" placeholder="Phone number without +" autofocus>
        </div>

        <div class="mb-3">
            <input id="tracking_id" type="number"  min="0" class="form-control" name="tracking_id" placeholder="Tracking ID">
        </div>

        <div class="center mb-3">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </div>
    </form>
    {{-- <hr>
    <p class="lead">
        <a class="btn btn-secondary" href="{{route('dashboard')}}" role="button">Check our other products</a>
    </p> --}}
</div>
@endsection
