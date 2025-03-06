@extends('admin/layout')
@section('page_title','Manage Brand')
@section('brand_select','active')
@section('container')
@if($id>0)
{{$image_required=""}}
@else
{{$image_required="required"}}
@endif


@error('image')
<div class="alert alert-danger mt-4">
<strong>{{$message}}</strong>
</div>
@enderror
<h1 class="mb-10">Manage Brand</h1>
<a href="{{url('admin/brand')}}" class="mt-2">
    <button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <!-- {{session('message')}} -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('brand.manage_brand_process')}}" method="post" novalidate="novalidate"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="brand" class="control-label mb-1">Brand</label>
                                <input id="brand" name="name" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false" value="{{$name}}" required>
                            </div>
                            @error('name')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror


                            <div class="form-group">
                                <label for="file" class="control-label mb-1">Image</label>
                                <input id="image" name="image" type="file" class="form-control" aria-required="true"
                                    aria-invalid="false" {{$image_required}}>
                            </div>
                            @error('image')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror

                        
                            <div class="mb-3">
                                <img width="100px;" src="{{asset('storage/media/brand/'.$image)}}" alt="">
                            </div>

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