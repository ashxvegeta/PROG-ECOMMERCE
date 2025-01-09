@extends('admin/layout')
@section('page_title','Manage Coupon')
@section('coupon_select','active')
@section('container')
<h1 class="mb-10">Manage Coupon</h1>
<a href="{{url('admin/coupon')}}" class="mt-2">
    <button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <!-- {{session('message')}} -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('coupon.manage_coupon_process')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="control-label mb-1">Title</label>
                                <input id="title" name="title" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false" value="{{$title}}" required>
                            </div>
                            @error('title')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror

                            <div class="form-group">
                                <label for="code" class="control-label mb-1">Code</label>
                                <input id="code" name="code" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false" value="{{$code}}" required>
                            </div>
                            @error('code')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror


                            <div class="form-group">
                                <label for="value" class="control-label mb-1">Value</label>
                                <input id="value" name="value" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false" value="{{$value}}" required>
                            </div>
                            @error('value')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror


                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Submit</span>
                                </button>
                            </div>
                            <input type="hidden"  value="{{$id}}" name="id">
                        </form>
                    </div>
                </div>
            </div>








        </div>
    </div>
</div>
@endsection