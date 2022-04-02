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

class HomeController extends Controller
{
    //
    public function index()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status', '1')->orderby('product_id', 'desc')->paginate(6);
        return view('pages.home')->with('category', $cate_product)->with('all_product', $all_product);
    }
    public function tim_kiem(Request $request)
    {

        $keyword = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();
        return view('pages.sanpham.search')->with('category', $cate_product)->with('search_product',$search_product);
    }
}
