@extends('admin/layout')
@section('page_title','Coupon')
@section('coupon_select','active')
    @section('container')
        @if(session('message'))
        <div class="alert alert-success">
        <strong>{{session('message')}}</strong>
        </div>
        @endif
    <h1 class="mb-10">Coupon</h1>
       <!-- <a href="category/manage_category" class="mt-2"> -->
       <a href="{{url('admin/coupon/manage_coupon/')}}" class="mt-2">
          <button type="button" class="btn btn-success">Add Coupon</button>
       </a>
    <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Code</th>
                                                <th>Value</th> 
                                                <th>Action</th> 

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $list)
                                            <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->title}}</td>
                                                <td>{{$list->code}}</td>
                                                <td>{{$list->value}}</td>
                                               <td>

                                               <a href="{{url('admin/coupon/manage_coupon/')}}/{{$list->id}}">
                                                <button class="btn btn-warning">Edit</button>
                                                </a>
                                                
                                                
                                                @if($list->status==1)
                                                <a href="coupon/status/0/{{$list->id}}">
                                                <button class="btn btn-success">Active</button>
                                                </a>
                                                @elseif($list->status==0)
                                                <a href="coupon/status/1/{{$list->id}}">
                                                <button class="btn btn-primary">Inative</button>
                                                </a>
                                                @endif
                                            
                                                <a href="coupon/delete/{{$list->id}}">
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