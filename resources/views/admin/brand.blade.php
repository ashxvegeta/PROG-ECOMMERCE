@extends('admin/layout')
@section('page_title','Brand')
@section('brand_select','active')



    @section('container')
        @if(session('message'))
        <div class="alert alert-success">
        <strong>{{session('message')}}</strong>
        </div>
        @endif
    <h1 class="mb-10">Brand</h1>
       <!-- <a href="category/manage_category" class="mt-2"> -->
       <a href="{{url('admin/brand/manage_brand/')}}" class="mt-2">
          <button type="button" class="btn btn-success">Add Brand</button>
       </a>
    <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Brand Name</th> 
                                                <th>Brand image</th> 
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $list)
                                            <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->name}}</td>
                                                <td>
                                                @if($list->image!='')
                                                <img width="100px;" src="{{asset('storage/media/brand/'.$list->image)}}" alt="{{$list->image}}">
                                                @endif
                                                </td>
                                               <td>

                                               <a href="{{url('admin/brand/manage_brand/')}}/{{$list->id}}">
                                                <button class="btn btn-warning">Edit</button>
                                                </a>

                                                @if($list->status==1)
                                                <a href="{{url('admin/brand/status/0')}}/{{$list->id}}">
                                                <button class="btn btn-success px-3">Active</button>
                                                </a>
                                                @elseif($list->status==0)
                                                <a href="{{url('admin/brand/status/1')}}/{{$list->id}}">
                                                <button class="btn btn-primary">Inative</button>
                                                </a>
                                                @endif

                                                <a href="brand/delete/{{$list->id}}">
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