@extends('layout')
@section('content')
@foreach($product_details as $key => $value)
<div class="product-details">

    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{URL::to('public/upload/product/'.$value->product_image)}}" alt="" height="220" width="100" />
            <h3>ZOOM</h3>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                    <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                    <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                </div>
            </div>
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information">
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$value->product_name}}</h2>
            <p>Mã sản phẩm: {{$value->product_id}}</p>
            <img src="images/product-details/rating.png" alt="" />
            <span>
                <form action="{{URL::to('/save-cart')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                    <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                    <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                    <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                    <input type="hidden" value="1 " class="cart_product_qty_{{$value->product_id}}">

                    <span>{{number_format($value->product_price).'VNĐ'}}</span>

                    <label>Số lượng:</label>
                    <input name="qty" type="number" min="1" value="1" />
                    <input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />

                </form>
                <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
            </span>
            <p><b>Trạng thái <i></i>:</b>Còn hàng</p>
            <p><b>Tình trạng:</b> Mới 100%</p>
            <p><b>Loại:</b> {{$value->category_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
        </div>
    </div>
</div>

<!--/product-information-->
<!--/product-details-->
<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
            <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details">
            <p>{!!$value->product_content!!}</p>
        </div>

        <div class="tab-pane fade" id="companyprofile">
            <p>{!!$value->product_desc!!}</p>
        </div>
    </div>
    <div class="tab-pane fade" id="reviews">
        <div class="col-sm-12">
        </div>
    </div>

</div>
@endforeach
<!--/category-tab-->
<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">Sản phẩm gợi ý</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($relate as $key => $goiy)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{$goiy->product_id}}" class="cart_product_id_{{$goiy->product_id}}">
                                    <input type="hidden" value="{{$goiy->product_name}}" class="cart_product_name_{{$goiy->product_id}}">
                                    <input type="hidden" value="{{$goiy->product_image}}" class="cart_product_image_{{$goiy->product_id}}">
                                    <input type="hidden" value="{{$goiy->product_price}}" class="cart_product_price_{{$goiy->product_id}}">
                                    <input type="hidden" value="1 " class="cart_product_qty_{{$goiy->product_id}}">
                                    <img src="{{URL::to('public/upload/product/'.$goiy->product_image)}}" alt="" height="100" width="50" />
                                    <h2>{{number_format($goiy->product_price).' '.'VNĐ'}}</h2>
                                    <p>{{$goiy->product_name}}</p>
                                </form>

                                <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$goiy->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>

@endsection