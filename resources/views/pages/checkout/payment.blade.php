@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
        <div class="register-req">
            <p>Đăng ký và đăng nhập để có thể thanh toán và xem lịch sử đơn hàng</p>
        </div>



        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <?php

                use Illuminate\Support\Facades\Session;

                $message = Session::get('message');
                if ($message) {
                    echo $message;
                    Session::put('message', null);
                }
                ?>
                <form action="{{url('/update-cart')}}" method="post">
                    @csrf
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td class="description">Tên sản phẩm</td>
                            <td class="quantity">Số lượng</td>
                            <td class="price">Giá</td>

                            <td class="total">Tổng tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total = 0;
                        @endphp

                        @foreach(Session::get('cart') as $key => $cart)
                        @php
                        $subtotal = $cart['product_price']*$cart['product_qty'];
                        $total+=$subtotal;
                        @endphp
                        <tr>
                            <td class="cart_product">
                                <img src="{{asset('public/upload/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
                            </td>
                            <td class="cart_description">
                                <h4><a href=""></a></h4>
                                <p>{{$cart['product_name']}}</p>
                            </td>

                            <td class="cart_quantity">
                                <div class="cart_quantity_button">

                                    <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" autocomplete="off" size="2">
                                </div>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($cart['product_price'],0,',','.')}} VNĐ</p>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    {{number_format($subtotal,0,',','.')}} VNĐ
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                            </td>

                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                <input type="submit" value="cập nhật" name="update_qty" class="check_out btn btn-default">
                            </td>
                        </tr>
                    </tbody>
                </form>

            </table>

        </div>
        <form action="{{URL::to('/order-place')}}" method="POST">
            {{csrf_field()}}
            <div class="payment-options">
                <span>
                    <label><input name="payment_option" value="1" type="checkbox"> Thanh toán bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox"> Tiền mặt khi nhận hàng</label>
                </span>
                <input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm">
            </div>
        </form>
    </div>
</section>
<!--/#cart_items-->
@endsection