<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Http\Requests;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Routing\Redirector;
// use Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Nette\Schema\Expect;

session_start();
class CustomerController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function all_customer()
    {
        $this->AuthLogin();
        $all_customers = DB::table('tbl_customers')->paginate(10);
        $manager_customers = view('admin.all_customer')->with('all_customers', $all_customers);
        return view('admin_layout')->with('admin.all_customer', $manager_customers);
       
    }
    public function edit_customerr($customerId){
        $this->AuthLogin();
        $edit_customer = DB::table('tbl_customers')->where('customer_id', $customerId)->get();
        $manager_customers = view('admin.edit_customer')->with('edit_customer', $edit_customer);
        return view('admin_layout')->with('admin.edit_customer', $manager_customers);
    }
    public function update_customer(Request $request, $customerId){
        $this->AuthLogin();
        $data = array();
        $data['customer_name'] = $request->input('customer_name');
        $data['customer_email'] = $request->input('customer_email');
        $data['customer_phone'] = $request->input('customer_phone');
        DB::table('tbl_customers')->where('customer_id', $customerId)->update($data);
        Session::put('message', 'Cập nhật thông tin thành công');
        return Redirect::to('all-customer');
    }
    public function delete_customer($customerId){
        $this->AuthLogin();
        DB::table('tbl_customers')->where('customer_id', $customerId)->delete();
        Session::put('message', 'Xóa tài khoản KHÁCH HÀNG thành công');
        return Redirect::to('all-customer');
    }
}
