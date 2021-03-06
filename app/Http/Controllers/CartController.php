<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Nette\Schema\Expect;

session_start();

use Cart;

class CartController extends Controller
{
    // public function save_cart(Request $request)
    // {
    //     // $productId = $request->productid_hidden;
    //     // $quantity = $request->qty;
    //     // $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
    //     // // $data = DB::table('tbl_product')->where('product_id',$productId)->get();
    //     // $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
    //     // // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    //     // $data['id']= $product_info->product_id;
    //     // $data['qty'] = $quantity;
    //     // $data['name'] = $product_info->product_name;
    //     // $data['price'] = $product_info->product_price;
    //     // $data['options'] = $product_info->product_image;
    //     // // Cart::add($data);
    //     // return view('pages.cart.show_cart')->with('category',$cate_product);

    // }
    public function addCartAjax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_available = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_available++;
                }
            }
            if ($is_available == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
        }
        Session::put('cart', $cart);
        Session::save();
    }
    public function gio_hang(Request $request)
    {
        $meta_desc = "Gi??? h??ng c???a b???n";
        $meta_keywords = "Gi??? h??ng Ajax";
        $meta_title = "Gi??? h??ng Ajax";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($data['cart_qty'] as $key => $qty) {
                foreach ($cart as $Session => $val) {
                    if ($val['session_id'] == $key) {
                        $cart[$Session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','C???p nh???t s??? l?????ng th??nh c??ng');

        }else{
            return redirect()->back()->with('message','C???p nh???t s??? l?????ng kh??ng th??nh c??ng');

        }
    }
    public function del_product($session_id)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'X??a th??nh c??ng s???n ph???m');
        } else {
            return redirect()->back()->with('message', 'X??a s???n ph???m th???t b???i');
        }
    }
}
