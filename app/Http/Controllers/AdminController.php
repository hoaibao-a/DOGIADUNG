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
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');

        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard()
    {
        $this->AuthLogin('admin_login');
        return view('admin.dashboard');
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->input('admin_email');
        $admin_password = md5($request->input('admin_password'));
        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();

       if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
       }else{
           Session::put('message','Vui lòng kiểm tra lại tài khoản và mật khẩu');
           return Redirect::to('/admin');
       }
        // return view('admin.dashboard');
    }
    public function log_out(Request $request)
    {
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return redirect::to('admin');
    }
    public function add_admin(){
        $this->AuthLogin();
        return view('admin.add_admin');
    }
    public function save_admin(Request $request){
        
        $this->AuthLogin();
        $data = array();
        $data['admin_name'] = $request->input('admin_name');
        $data['admin_phone'] = $request->input('admin_phone');
        $data['admin_email'] = $request->input('admin_email');
        $data['admin_password'] =md5($request->input('admin_password'));
        DB::table('tbl_admin')->insert($data);
        Session::put('message', 'Thêm người quản trị thành công');
        return Redirect::to('add-admin');
    }
    public function all_admin(){
        $this->AuthLogin();
        $all_admin = DB::table('tbl_admin')->paginate(10);
        $manager_admin = view('admin.all_admin')->with('all_admin', $all_admin);
        return view('admin_layout')->with('admin.all_admin', $manager_admin);
    }
    public function edit_admin($AdminID){
        $this->AuthLogin();
        $edit_admin = DB::table('tbl_admin')->where('admin_id', $AdminID)->get();
        $manager_admin = view('admin.edit_admin')->with('edit_admin', $edit_admin);
        return view('admin_layout')->with('admin.edit_admin', $manager_admin);
    }
    public function update_admin(Request $request, $AdminID){
        $this->AuthLogin();
        $data = array();
        $data['admin_name'] = $request->input('admin_name');
        $data['admin_email'] = $request->input('admin_email');
        $data['admin_phone'] = $request->input('admin_phone');
        $data['admin_password'] = $request->input('admin_password');
        DB::table('tbl_admin')->where('admin_id', $AdminID)->update($data);
        Session::put('message', 'Cập nhật thông tin admin thành công ');
        return Redirect::to('all-admin');
    }
    public function delete_admin($AdminID){
        $this->AuthLogin();
        DB::table('tbl_admin')->where('admin_id', $AdminID)->delete();
        Session::put('message', 'Xóa tài khoản admin thành công');
        return Redirect::to('all-admin');
    }
}