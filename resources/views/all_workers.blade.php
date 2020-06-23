@extends('layouts.app')
@include('inc.messages')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-header">Orders</div>
                        <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="card">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    {{-- <th scope="col">#</th> --}}
                                    <th scope="col">Name</th>
                                    {{-- <th scope="col">Last Name</th> --}}
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">State</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($workers as $item)
                                    <tr>
                                        {{-- <td>{{$item->id}}</td> --}}
                                        <td>{{$item->name}} {{$item->last_name}}</td>
                                        {{-- <td>{{$item->last_name}}</td> --}}
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->tel}}</td>
                                        <td>{{$item->state}}</td>
                                        <td>{{$item->city}}</td>
                                        <td>
                                            <form action="{{ route('postalworker.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>           
                        </div>
                        <br/>
                        <a class="btn btn-primary float-right" href="/addworker" role="button" >Add worker</a>                 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
