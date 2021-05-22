@extends('layouts.admin_layout.admin_layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Catalogues </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products images</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if($errors->any())
                    <div class="alert alert-danger" style="margin-top: 10px;">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form name="addImagesForm" id="addImagesForm"
                      method="post"  action="{{url('admin/add-images/'.$productdata['id'])}}" enctype="multipart/form-data">@csrf
                    @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{Session::get('success_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{Session::get('error_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Product Name:</label>&nbsp;{{$productdata['product_name']}}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">Product Code:</label>&nbsp;{{$productdata['product_code']}}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product Color:</label>&nbsp;{{$productdata['product_color']}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img style="width:120px; " src="{{asset('images/product_images/small/'.$productdata['main_image'])}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div>
                                                <input multiple="" id="images" name="images[]" type="file" name="images[]" value=""
                                                       required=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add images</button>
                        </div>
                    </div>
                </form>

                <form name="updateImageForm" id="updateImageForm"
                      method="post" action="{{url('admin/edit-images/'.$productdata['id'])}}">@csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Added Product Images</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="products" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productdata['images'] as $image)
                                    <input style="display: none;" type="text" name="attrId[]" value="{{$image['id']}}">
                                    <tr>
                                        <td>{{$image['id']}}</td>
                                        <td><img style="width:120px;" src="{{asset('images/product_images/small/'.$image['image'])}}"></td>
                                        <td>@if($image['status']==1)
                                                <a class="updateImageStatus" id="image-{{$image['id']}}" image_id="{{$image['id']}}" href="javascript:void(0)">Active</a>
                                            @else
                                                <a class="updateImageStatus" id="image-{{$image['id']}}" image_id="{{$image['id']}}" href="javascript:void(0)">Inactive</a>
                                            @endif
                                            &nbsp;&nbsp;
                                            <a title="Delete Attribute" href="javascript:void(0)" class="confirmDelete" record="image" recordid="{{$image['id']}}"
                                            ><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update images</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </form>
            </div>
        </section>
    </div>

@endsection
