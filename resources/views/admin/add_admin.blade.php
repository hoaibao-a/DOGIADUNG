@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh tài khoản quản trị
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
                    <form role="form" action="{{URL::to('/save-admin')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên người quản trị</label>
                            <input type="text" class="form-control" name="admin_name" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="phone" class="form-control" name="admin_phone" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="admin_email" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu</label>
                            <input type="text" class="form-control" name="admin_password" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <button type="submit" name="add-product" class="btn btn-info">Thêm người quản trị</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection