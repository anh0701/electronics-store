<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;
use Illuminate\Support\Facades\Redirect;

class GioHangController extends Controller
{

    public function ThemGioHang(Request $request){
        $data = $request->all();
        // khi mỗi sp dc thêm vào giỏ hàng thì tạo 1 $session_id làm vc thic dựa vào $session_id đó
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if($cart == true){
            $is_avaiable = 0;
            foreach($cart as $key => $value){
                if($value['MaSanPham'] == $data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'MaSanPham' => $data['cart_product_id'],
                    'TenSanPham' => $data['cart_product_name'],
                    'HinhAnh' => $data['cart_product_image'],
                    'SoLuong' => $data['cart_product_qty'],
                    'GiaSanPham' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'MaSanPham' => $data['cart_product_id'],
                'TenSanPham' => $data['cart_product_name'],
                'HinhAnh' => $data['cart_product_image'],
                'SoLuong' => $data['cart_product_qty'],
                'GiaSanPham' => $data['cart_product_price'],
            );
        }
        Session::put('cart', $cart);
        Session::save();
    }

    public function HienThiGioHang(Request $request){

        // $meta_desc = "Giỏ hàng của bạn";
        // $meta_keywords = "Giỏ hàng ajax";
        // $meta_title = "Giỏ hàng ajax";
        // $url_canonical = $request->url();
        // $image_og = $url_canonical.'/upload/product/logo.jpg';

        return view('pages.GioHang.GioHang');
        // ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'));
    } 

    public function XoaSanPhamTrongGioHang($session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $value){
                if($value['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message', 'Xóa sản phẩm khỏi giỏ hàng thành công');
        }else{
            return Redirect()->back()->with('message', 'Xóa sản phẩm khỏi giỏ hàng thất bại');
        }
    }

    public function ThayDoiSoLuong(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $session => $value){
                if($value['session_id'] == $data['cartid']){
                    $cart[$session]['SoLuong'] =  $data['qty'];
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back();
        }else{
            return Redirect()->back();
        }
    }
}
