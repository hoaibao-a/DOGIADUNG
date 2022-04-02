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


class CheckoutController extends Controller
{
    public function login_checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        return view('pages.checkout.login_checkout')->with('category', $cate_product);
    }
    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->input('customer_name');
        $data['customer_email'] = $request->input('customer_email');
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->input('customer_phone');

        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }
    public function checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        return view('pages.checkout.show_checkout')->with('category', $cate_product);
    }
    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_email'] = $request->input('shipping_email');
        $data['shipping_name'] = $request->input('shipping_name');
        $data['shipping_address'] = $request->input('shipping_address');
        $data['shipping_phone'] = $request->input('shipping_phone');
        $data['shipping_note'] = $request->input('shipping_note');
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }
    public function payment()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        return view('pages.checkout.payment')->with('category', $cate_product);
    }
    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    public function order_place(Request $request)
    {

        // $content = Session::get('cart');
        // print_r($content);
        // echo '</pre>';

        $total = 0;
        foreach (Session::get('cart') as $key => $cart) {
            $subtotal = $cart['product_price'] * $cart['product_qty'];
            $total += $subtotal;
        }
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chở xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = number_format($total, 0, ',', '.');
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        $content = Session::get('cart');
        foreach ($content as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content['product_id'];
            $order_d_data['product_name'] = $v_content['product_name'];
            $order_d_data['product_price'] = $v_content['product_price'];
            $order_d_data['product_sales_quantity'] = $v_content['product_qty'];
            DB::table('tbl_order_detail')->insert($order_d_data);
        }
        if ($data['payment_method'] == 1) {
            echo 'thanh toán thẻ atm';
        } elseif ($data['payment_method'] == 2) {
            Session::forget('cart');
            $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
            return view('pages.checkout.handcash')->with('category', $cate_product);
        }
        return Redirect::to('/payment');
    }
}
