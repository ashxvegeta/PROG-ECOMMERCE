@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
@section('container')
@if($id>0)
{{$image_required=""}}
@else
{{$image_required="required"}}
@endif

<h1 class="mb-10">Manage Product</h1>
<a href="{{url('admin/product')}}" class="mt-2">
    <button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <!-- {{session('message')}} -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('product.manage_product_process')}}" method="post" novalidate="novalidate"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category" class="control-label mb-1">Product</label>
                                <input id="name" name="name" type="text" class="form-control" aria-required="true"
                                    aria-invalid="false" value="{{$name}}" required>
                            </div>
                            @error('category')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror

                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Slug</label>
                                <input id="slug" name="slug" type="text" class="form-control" aria-required="true"
                                    aria-invalid="false" value="{{$slug}}" required>
                            </div>
                            @error('slug')
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

                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">slug</label>
                                <input id="slug" name="slug" type="text" class="form-control" aria-required="true"
                                    aria-invalid="false" value="{{$slug}}" required>
                            </div>
                            @error('slug')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror




                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="category_id" class="control-label mb-1">Category</label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">Select categories</option>
                                            @foreach($category as $list)
                                            @if($category_id==$list->id)
                                            <option value="{{$list->id}}" @if($category_id==$list->id)selected
                                                @endif>{{$list->category_name}}</option>
                                            @else
                                            <option value="{{$list->id}}">{{$list->category_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="brand" class="control-label mb-1">Brand</label>
                                        <input id="brand" name="brand" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" value="{{$brand}}" required>
                                    </div>
                                    @error('brand')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-1">Model</label>
                                        <input id="model" name="model" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" value="{{$model}}" required>
                                    </div>
                                    @error('model')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="short_desc" class="control-label mb-1">Short Desc</label>
                                <textarea id="short_desc" name="short_desc" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false">{{$short_desc}}</textarea>
                            </div>
                            @error('short_desc')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror


                            <div class="form-group">
                                <label for="desc" class="control-label mb-1">Desc</label>
                                <textarea id="desc" name="desc" type="text" class="form-control" aria-required="true"
                                    aria-invalid="false">{{$desc}}</textarea>
                            </div>
                            @error('desc')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror

                            <div class="form-group">
                                <label for="keywords" class="control-label mb-1">Keywords</label>
                                <textarea id="keywords" name="keywords" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false">{{$keywords}}</textarea>
                            </div>
                            @error('keywords')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror


                            <div class="form-group">
                                <label for="technical_specification" class="control-label mb-1">Technical
                                    specification</label>
                                <textarea id="technical_specification" name="technical_specification" type="text"
                                    class="form-control" aria-required="true"
                                    aria-invalid="false">{{$technical_specification}}</textarea>
                            </div>
                            @error('technical_specification')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror


                            <div class="form-group">
                                <label for="uses" class="control-label mb-1">Uses</label>
                                <textarea id="uses" name="uses" type="text" class="form-control" aria-required="true"
                                    aria-invalid="false">{{$uses}}</textarea>
                            </div>
                            @error('uses')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror

                            <div class="form-group">
                                <label for="warranty" class="control-label mb-1">Warranty</label>
                                <textarea id="warranty" name="warranty" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false">{{$warranty}}</textarea>
                            </div>
                            @error('warranty')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror











                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Submit</span>
                                </button>
                            </div>
                            <input type="hidden" value="{{$id}}" name="id">
                        </form>
                    </div>
                </div>
            </div>








        </div>
    </div>
</div>
@endsection