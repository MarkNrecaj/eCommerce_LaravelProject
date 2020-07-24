@extends('layouts.app')

@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom-container">
                    <div class="card-header text-center">Add New Product</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">

                            <div class="card-body">
                                <form class="custom-form" method="POST" action="{{route('addProduct')}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name ') }}<span>*</span></label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') eshte jo valide @enderror" name="name" value="{{ old('name') }}" autocomplete="given-name" required>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Product Description') }}</label>

                                        <div class="col-md-6">
                                            <input id="description" type="text" class="form-control @error('description') eshte jo valide @enderror" name="description" value="{{ old('description') }}" autocomplete="off">

                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Upload Images') }}</label>
                                            <div class="col-md-6 ">
                                                <div class="custom-file">
                                                    <label class="custom-file-label" for="images">Choose file...</label>
                                                    <input id="images" type="file" class="custom-file-input @error('images[]') eshte jo valide @enderror" name="images[]" multiple>

                                                    @error('images[]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Product Price ') }}<span>*</span></label>

                                        <div class="col-md-6">
                                            {{-- <input id="price" type="number" value="0" onchange="calculateTotalPrice()" min="0" step="0.01" class="form-control @error('price') eshte jo valide @enderror" name="price" value="{{ old('price') }}" autocomplete="off" required> --}}
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text text-muted">€</span>
                                                </div>
                                                <input name="price" id="price" type="number" value="0" onchange="calculateTotalPrice()" min="0" step="0.01" class="form-control @error('price') eshte jo valide @enderror" value="{{ old('price') }}" autocomplete="off" required>
                                              </div>
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                                        <div class="col-md-6">
                                            <input id="quantity" type="number" value="1" class="form-control @error('quantity') eshte jo valide @enderror" name="quantity" value="{{ old('quantity') }}" autocomplete="off" min="1" required>

                                            @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight (gr)') }}</label>

                                        <div class="col-md-6">
                                            <input id="weight" type="number" value="0" class="form-control @error('weight') eshte jo valide @enderror" name="weight" value="{{ old('weight') }}" autocomplete="off" min="0">

                                            @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_type" class="col-md-4 col-form-label text-md-right">{{ __('Product type') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-control @error('product_type') eshte jo valide @enderror" name="product_type" value="{{ old('product_type') }}" required>
                                                <option value="Normal">Normal</option>
                                                <option value="Fragile">Fragile</option>
                                            </select>

                                            @error('product_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_openable" class="col-md-4 col-form-label text-md-right">{{ __('Can be opened') }}</label>

                                        <div class="col-md-6">
                                            <input id="is_openable" type="checkbox" class="form-control @error('is_openable') eshte jo valide @enderror" name="is_openable" value="{{ old('is_openable') }}" autocomplete="off">

                                            @error('is_openable')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_returnable" class="col-md-4 col-form-label text-md-right">{{ __('Can be returned') }}</label>

                                        <div class="col-md-6">
                                            <input id="is_returnable" type="checkbox" class="form-control @error('is_returnable') eshte jo valide @enderror" name="is_returnable" value="{{ old('is_returnable') }}" autocomplete="off">

                                            @error('is_returnable')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row center">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Add Product') }}
                                            </button>
                                    </div>
                                    <span>*</span><small> required fields</small>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
