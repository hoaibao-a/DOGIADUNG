@extends('layout')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				<li class="active">Giỏ hàng của bạn</li>
			</ol>
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
						@if(Session::get('cart')==true)
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
								<li>Tổng tiền:<span>{{number_format($total,0,',','.')}} VNĐ</span></li>
							</td>
							<td>
								<input type="submit" value="cập nhật" name="update_qty" class="check_out btn btn-default">
							</td>
							<td>
								<?php
								$customer_id = Session::get('customer_id');
								if ($customer_id != NULL) {
								?>
									<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh Toán</a>
								<?php
								} else {
								?>
									<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh Toán</a>
								<?php
								}
								?>
							</td>
						</tr>
						@else
						<tr>
							<td colspan="5">
								<center>
									@php
									echo 'Thêm sản phẩm vào giỏ hàng';
									@endphp
								</center>
							</td>
						</tr>
						@endif
					</tbody>
				</form>

			</table>

		</div>
	</div>
</section>

@endsection