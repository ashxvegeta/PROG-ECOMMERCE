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
        <form action="{{route('product.manage_product_process')}}" method="post" novalidate="novalidate"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    <!-- {{session('message')}} -->
                    <div class="card">
                        <div class="card-body">
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <h2 class="pt-3 pb-3">Product Attribute</h2>
                <div class="col-lg-12" id="product_attr_box">
                    <!-- {{session('message')}} -->
                    @foreach($productsAttrArr as $key=>$val)
                    <?php
                    
                        $pAArr = array($val);
                    ?>
                    <div class="card" id="product_attr_1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="brand" class="control-label mb-1">SKU</label>
                                        <input id="sku" name="sku[]" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" value="" required>
                                    </div>
                                    @error('sku')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="mrp" class="control-label mb-1">MRP</label>
                                        <input id="mrp" name="mrp[]" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" value="" required>
                                    </div>
                                    @error('mrp')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="price" class="control-label mb-1">Price</label>
                                        <input id="price" name="price[]" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" value="" required>
                                    </div>
                                    @error('price')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="size_id" class="control-label mb-1">Select Size</label>
                                        <select name="size_id[]" id="size_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($sizes as $list)

                                            <option value="{{$list->id}}">{{$list->size}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                    @error('size_id')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="color_id" class="control-label mb-1">Select Color</label>
                                        <select name="color_id[]" id="color_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($colors as $list)
                                            <option value="{{$list->id}}">{{$list->color}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('color_id')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="qty" class="control-label mb-1">Qty</label>
                                        <input id="qty" name="qty[]" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" value="" required>
                                    </div>
                                    @error('qty')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="attr_image" class="control-label mb-1">Image</label>
                                    <input id="attr_image" name="attr_image[]" type="file" class="form-control"
                                        aria-required="true" aria-invalid="false" {{$image_required}}>
                                </div>
                                <div class="col-4 mt-4">
                                    <button type="button" class="btn btn-success btn-lg"
                                        onclick="add_more()">+Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <input type="hidden" value="{{$id}}" name="id">
            <div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                    <span id="payment-button-amount">Submit</span>
                </button>
            </div>
        </form>
    </div>
</div>
<script>
var loop_count = 1;

function add_more() {
    loop_count++;
    var html = '<div class="card" id="product_attr_' + loop_count + '"><div class="card-body"><div class="row">';
    html +=
        '<div class="col-2"><div class="form-group"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required></div></div>';
    html +=
        '<div class="col-2"><div class="form-group"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required></div></div>';
    html +=
        '<div class="col-2"><div class="form-group"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required></div></div>';
    var size_id_html = $('#size_id').html();
    html +=
        '<div class="col-3"><label for="size_id" class="control-label mb-1">Select Size</label><select name="size_id[]" id="size_id" class="form-control">' +
        size_id_html + '</select></div>';
    var color_id_html = $('#color_id').html();
    html +=
        '<div class="col-3"><label for="color_id" class="control-label mb-1">Select Color</label><select name="color_id[]" id="color_id" class="form-control">' +
        color_id_html + '</select></div>';
    html +=
        '<div class="col-2"><div class="form-group"><label for="qty" class="control-label mb-1">Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required></div></div>';
    html +=
        '<div class="col-4"><div class="form-group"><label for="attr_image" class="control-label mb-1">Image</label><input type="file" id="attr_image" name="attr_image[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required></div></div>';
    html += '<div class="col-4 mt-4"><button type="button" class="btn btn-danger btn-lg" onclick="remove_more(' +
        loop_count + ')">-Remove</button></div>';
    html += '</div></div></div>';
    $('#product_attr_box').append(html);
}

function remove_more(loop_count) {
    $('#product_attr_' + loop_count).remove();
}
</script>

@endsection