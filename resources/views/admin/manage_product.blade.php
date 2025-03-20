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

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>

@if(session('sku_error'))
        <div class="alert alert-danger mt-4">
        <strong>{{session('sku_error')}}</strong>
        </div>
@endif

@error('attr_image.*')
<div class="alert alert-danger mt-4">
<strong>{{$message}}</strong>
</div>
@enderror

@error('images.*')
<div class="alert alert-danger mt-4">
<strong>{{$message}}</strong>
</div>
@enderror

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
                            <!-- <div class="form-group">
                                <label for="slug" class="control-label mb-1">slug</label>
                                <input id="slug" name="slug" type="text" class="form-control" aria-required="true"
                                    aria-invalid="false" value="{{$slug}}" required>
                            </div>
                            @error('slug')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror -->
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
                                        <select name="brand" id="brand" class="form-control" required>
                                            <option value="">Select categories</option>
                                            @foreach($brands as $list)
                                            @if($brand==$list->id)
                                            <option value="{{$list->id}}" @if($brand==$list->id)selected
                                                @endif>{{$list->name}}</option>
                                            @else
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
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

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="lead_time" class="control-label mb-1">Lead Time</label>
<input id="lead_time" value="{{$lead_time}}" name="lead_time" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                    </div>
                                    @error('lead_time')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                             
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="tax" class="control-label mb-1">Tax</label>
<input id="tax" value="{{$tax}}" name="tax" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                    </div>
                                    @error('tax')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-1">tax type</label>
                                        <input id="tax_type" value="{{$tax_type}}" name="tax_type" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                    </div>
                                    @error('tax_type')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>


<!--  -->

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="is_promo" class="control-label mb-1">Is pramotional</label>

                                    <select name="is_promo" id="is_promo" class="form-control">
                                        @if(($is_promo)==1) 
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                       
                                        @else 
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                        @endif
                                    
                                    </select>
                                    </div>
                                    @error('is_promo')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                             
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="tax" class="control-label mb-1">Tax</label>
<input id="tax" value="{{$tax}}" name="tax" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                    </div>
                                    @error('tax')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-1">tax type</label>
                                        <input id="tax_type" value="{{$tax_type}}" name="tax_type" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                    </div>
                                    @error('tax_type')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-1">tax type</label>
                                        <input id="tax_type" value="{{$tax_type}}" name="tax_type" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                    </div>
                                    @error('tax_type')
                                    <div class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <!--  -->


                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <h2 class="pt-3 pb-3">Product Attribute</h2>
                <div class="col-lg-12" id="product_attr_box">
                    @php
                    $loop_count_num=1;
                    @endphp
                    @foreach($productsAttrArr as $key=>$val)
                    @php
                      $loop_count_prev =  $loop_count_num;
                      $pAArr =  json_decode(json_encode($val),true);
                    @endphp
                    <input type="hidden" id="paid" name="paid[]" value="{{$pAArr['id']}}">
                    <div class="card" id="product_attr_{{$loop_count_num++}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="brand" class="control-label mb-1">SKU</label>
                                        <input id="sku" name="sku[]" type="text" class="form-control"
                                            aria-required="true" aria-invalid="false" value="{{$pAArr['sku']}}" required>
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
                                            aria-required="true" aria-invalid="false" value="{{$pAArr['mrp']}}" required>
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
                                            aria-required="true" aria-invalid="false" value="{{$pAArr['price']}}" required>
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
                                            @if($pAArr['size_id']==$list->id)
                                            <option value="{{$list->id}}" selected>{{$list->size}}</option>
                                            @else
                                            <option value="{{$list->id}}">{{$list->size}}</option>    
                                            @endif
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
                                            @if($pAArr['color_id']==$list->id)
                                            <option value="{{$list->id}}" selected>{{$list->color}}</option>
                                            @else
                                            <option value="{{$list->id}}">{{$list->color}}</option>
                                            @endif
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
                                            aria-required="true" aria-invalid="false" value="{{$pAArr['qty']}}" required>
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
                                        @if($pAArr['attr_image']!='')
                                        <img width="100px;" src="{{asset('storage/media/'.$pAArr['attr_image'])}}" alt="{{$pAArr['attr_image']}}">
                                        @endif    
                                </div>
                                <div class="col-4 mt-4">
                                    @if($loop_count_num==2)
                                    <button type="button" class="btn btn-success btn-lg"
                                        onclick="add_more()">+Add</button>
                                    @else
                                    <a href="{{url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}">
                                    <button type="button" class="btn btn-danger btn-lg"
                                        onclick="remove_more({{$loop_count_prev}})">-Remove</button>
                                        </a>
                                    @endif                                          
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


            <!-- product -->


                <h2 class="pt-3 pb-3">Product Images</h2>
                <div class="col-lg-12" >
                    
                    <div class="card" >
                        <div class="card-body">
                            <div class="row" id="product_image_box">    
                            @php
                    $loop_count_num=1;
                    @endphp
                    @foreach($productsImagesArr as $key=>$val)
                    @php
                      $loop_count_prev =  $loop_count_num;
                      $pIArr =  json_decode(json_encode($val),true);
                    @endphp
                    <input type="hidden" id="piid" name="piid[]" value="{{$pIArr['id']}}">
                                <div class="col-4" class="product_images_{{$loop_count_num++}}" >
                                    <label for="images" class="control-label mb-1">Image</label>
                                    <input id="images" name="images[]" type="file" class="form-control"
                                        aria-required="true" aria-invalid="false" {{$image_required}}>
                                        @if($pIArr['images']!='')
                                        <a href="{{asset('storage/media/'.$pIArr['images'])}}" target="_blank">
                                        <img width="100px;" src="{{asset('storage/media/'.$pIArr['images'])}}" alt="{{$pIArr['images']}}">
                                        </a>
                                        @endif    
                                </div>


                                

                                <div class="col-2 mt-4" >
                                    @if($loop_count_num==2)
                                    <button type="button" class="btn btn-success btn-lg"
                                        onclick="add_image_more()">+Add</button>
                                    @else
                                    <a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$id}}">
                                    <button type="button" class="btn btn-danger btn-lg"
                                        onclick="remove_more({{$loop_count_prev}})">-Remove</button>
                                        </a>
                                    @endif                                                        
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
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
    var html = '<input type="hidden" id="paid" name="paid[]" value=""><div class="card" id="product_attr_' + loop_count + '"><div class="card-body"><div class="row">';
    
    html +=
        '<div class="col-2"><div class="form-group"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required></div></div>';
    
    html +=
        '<div class="col-2"><div class="form-group"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required></div></div>';
    
    html +=
        '<div class="col-2"><div class="form-group"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required></div></div>';
    var size_id_html = $('#size_id').html();
    size_id_html = size_id_html.replace("selected","");
    html +=
        '<div class="col-3"><label for="size_id" class="control-label mb-1">Select Size</label><select name="size_id[]" id="size_id" class="form-control">' +
        size_id_html + '</select></div>';
    var color_id_html = $('#color_id').html();
    color_id_html = color_id_html.replace("selected","");
    
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

// product_image_box
var loop_image_count = 1;
function add_image_more() {
    
    loop_image_count++;
    var html =
        '<input type="hidden" id="piid" name="piid[]" value=""><div class="col-4 product_images_'+loop_image_count+'"><div class="form-group"><label for="images" class="control-label mb-1">Image</label><input type="file" id="images" name="images[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required></div></div>';
    html += '<div class="col-2 mt-4 product_images_'+loop_image_count+'"><button type="button" class="btn btn-danger btn-lg" onclick="remove_image_more(' +
    loop_image_count + ')">-Remove</button></div>';

    $('#product_image_box').append(html);
}
function remove_image_more(loop_image_count) {
    $('product_images_' + loop_image_count).remove();
}
CKEDITOR.replace('short_desc');
</script>

@endsection