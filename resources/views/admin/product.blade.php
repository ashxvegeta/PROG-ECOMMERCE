@extends('admin/layout')
@section('page_title','Product')
@section('product_select','active')



    @section('container')
        @if(session('message'))
        <div class="alert alert-success">
        <strong>{{session('message')}}</strong>
        </div>
        @endif
    <h1 class="mb-10">Product</h1>
       <!-- <a href="product/manage_category" class="mt-2"> -->
       <a href="{{url('admin/product/manage_product/')}}" class="mt-2">
          <button type="button" class="btn btn-success">Add Product</button>
       </a>
    <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product Name</th>
                                                <th>Product Slug</th>
                                                <th>Image</th>
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $list)
                                            <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->name}}</td>
                                                <td>{{$list->slug}}</td>
                                                <td>
                                                @if($list->image!='')
                                                <img width="100px;" src="{{asset('storage/media/'.$list->image)}}" alt="{{$list->image}}">
                                                @endif
                                                </td>
                                               <td>

                                               <a href="{{url('admin/product/manage_product/')}}/{{$list->id}}">
                                                <button class="btn btn-warning">Edit</button>
                                                </a>

                                                @if($list->status==1)
                                                <a href="{{url('admin/product/status/0')}}/{{$list->id}}">
                                                <button class="btn btn-success px-3">Active</button>
                                                </a>
                                                @elseif($list->status==0)
                                                <a href="{{url('admin/product/status/1')}}/{{$list->id}}">
                                                <button class="btn btn-primary">Inative</button>
                                                </a>
                                                @endif

                                                <a href="product/delete/{{$list->id}}">
                                                <button class="btn btn-danger">Delete</button>
                                                </a>
                                                
                                            
                                                
                                               </td>
                                            </tr>
                                            @endforeach
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
    @endsection