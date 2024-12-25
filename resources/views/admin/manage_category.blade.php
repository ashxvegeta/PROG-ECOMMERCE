@extends('admin/layout')

@section('container')
<h1 class="mb-10">Manage Category</h1>
<a href="category" class="mt-2">
    <button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <!-- {{session('message')}} -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('category.insert')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="category" class="control-label mb-1">Category</label>
                                <input id="category" name="category" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false" value="" required>
                            </div>
                            @error('category')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror

                            <div class="form-group">
                                <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                <input id="category_slug" name="category_slug" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false" value="" required>
                            </div>
                            @error('category_slug')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Submit</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>








        </div>
    </div>
</div>
@endsection