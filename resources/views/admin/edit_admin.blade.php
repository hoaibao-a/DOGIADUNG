@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa admin
            </header>
            <div class="panel-body">
                @foreach($edit_admin as $key => $edit_ad)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-admin/'.$edit_ad->admin_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên admin</label>
                            <input type="text" class="form-control" name="admin_name" id="exampleInputEmail1" value="{{($edit_ad->admin_name)}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" class="form-control" name="admin_phone" id="exampleInputEmail1" value="{{($edit_ad->admin_phone)}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="admin_email" id="exampleInputEmail1" value="{{($edit_ad->admin_email)}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu</label>
                            <input type="password" class="form-control" name="admin_password" id="exampleInputEmail1" value="{{($edit_ad->admin_password)}}">
                        </div>
                        <button type="submit" name="edit_adtomer" class="btn btn-info">Cập nhật thông tin admin</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection