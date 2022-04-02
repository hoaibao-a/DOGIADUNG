@extends('admin_layout')
@section('admin_content')


<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách tài khoản admin
        </div>
        <div class="row w3-res-tb">
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên admin</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                       
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
                    @foreach($all_admin as $key => $adm )
                    <tr>
                        <td>{{$adm -> admin_name}}</td>
                        <td>{{$adm -> admin_phone}}</td>
                        <td>{{$adm -> admin_email}}</td>
                        <td>
                            <a href="{{URL::to('/edit-admin/'.$adm->admin_id)}}" class="active" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc chắn xóa admin ?')" href="{{URL::to('/delete-admin/'.$adm->admin_id)}}" class="active" ui-toggle-class="">
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
                      {{$all_admin->links()}}
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>



@endsection