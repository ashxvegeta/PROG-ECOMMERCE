@extends('admin/layout')
@section('page_title','Manage Size')
@section('size_select','active')
@section('container')
<h1 class="mb-10">Manage Size</h1>
<a href="{{url('admin/size')}}" class="mt-2">
    <button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <!-- {{session('message')}} -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('size.manage_size_process')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="size" class="control-label mb-1">Size</label>
                                <input id="size" name="size" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false" value="{{$size}}" required>
                            </div>
                            @error('size')
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