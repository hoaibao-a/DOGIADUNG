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
                    <form role="form" action="{{URL::to('/save_category_product')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" name="category_product_name" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="category_product_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiển Thị</label>
                            <select class="form-control input-sm-m-bot15" name="category_product_status">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển</option>
                            </select>
                        </div>

                        <button type="submit" name="add-product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection