@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục sản phẩm
            </header>
            <div class="panel-body">
                @foreach($edit_customer as $key => $edit_cus)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-customer/'.$edit_cus->customer_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên khách hàng</label>
                            <input type="text" class="form-control" name="customer_name" id="exampleInputEmail1" value="{{($edit_cus->customer_name)}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên khách hàng</label>
                            <input type="text" class="form-control" name="customer_email" id="exampleInputEmail1" value="{{($edit_cus->customer_phone)}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên khách hàng</label>
                            <input type="text" class="form-control" name="customer_phone" id="exampleInputEmail1" value="{{($edit_cus->customer_email)}}">
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu khách hàng</label>
                            <input type="password" class="form-control" name="product_name" id="exampleInputEmail1" value="{{($edit_cus->customer_password)}}">
                        </div> -->
                        <button type="submit" name="edit_customer" class="btn btn-info">Cập nhật thông tin khách hàng</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection