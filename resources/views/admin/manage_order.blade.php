@extends('admin_layout')
@section('admin_content')



<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
           Liệt kê đơn hàng
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên người đặt</th>
                        <th>Tổng giá tiền</th>
                        <th>Tình trạng</th>
                        <th>Hiển thị</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <?php

                use Illuminate\Support\Facades\Session;

                $message = Session::get('message');
                if ($message) {
                    echo $message;
                    Session::put('message', null);
                }
                ?>
                <tbody>
                    @foreach($all_order as $key => $order )
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$order ->customer_name}}</td>
                        <td>{{$order ->order_total}}</td>
                        <td>{{$order ->order_status}}</td>
                        <td>
                            <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc chắn xóa đơn hàng không ?')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                      
                    {{$all_order->links()}}
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>



@endsection