@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>

            <?php

            use Illuminate\Support\Facades\Session;

            $message = Session::get('message');
            if ($message) {
                echo $message;
                Session::put('message', null);
            }
            ?>

            <div class="panel-body">
                <div class="position-center">
                    @foreach($edit_product as $key => $pro)
                    <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="product_name" id="exampleInputEmail1" value="{{($pro->product_name)}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" class="form-control" name="product_price" id="exampleInputEmail1" value="{{($pro->product_price)}}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" name="product_image" id="exampleInputEmail1">
                            <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" height="100" width="100">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm">{{($pro->product_desc)}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm sản phẩm</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Mô tả nội dung sản phẩm">{{($pro->product_content)}}</textarea>
                        </div>  
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select class="form-control input-sm m-bot15" name="product_cate">
                              @foreach($cate_product as $key => $cate)
                              @if($cate->category_id==$pro->category_id)
                              <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                              @else
                              <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                              @endif
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Hiển Thị</label>
                        <select class="form-control input-sm m-bot15" name="product_status">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiển</option>
                        </select>
                    </div>

                    <button type="submit" name="add-product" class="btn btn-info">Cập nhật sản phẩm</button>
                </form>
                @endforeach
            </div>

        </div>
    </section>
</div>
</div>
@endsection