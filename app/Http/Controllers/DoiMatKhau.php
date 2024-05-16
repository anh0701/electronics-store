<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DoiMatKhau extends Controller
{
    public  function index()
    {
        return view('auth.doiMatKhau');
    }
    //
    public function doiMatKhau(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'MatKhauCu' => ['required', 'string', 'min:8'],
            'MatKhauCu' => ['required', 'string'],
            'MatKhauMoi' => ['required', 'string'],
            'MatKhauMoi2' => ['required', 'string'],
        ],[
            'MatKhauCu.required' => 'Vui lòng nhập mật khẩu cũ.',
            'MatKhauMoi.required' =>'Vui lòng nhập mật khẩu mới.',
            'MatKhauMoi2.required' =>'Vui lòng nhập lại mật khẩu mới.'
        ]);

        if ($validator->fails()) {
//            $message = $validator->errors();
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors( $validator->errors());
//            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $user = TaiKhoan::where('TenTaiKhoan', $request->session()->get('user.TenTaiKhoan'))->first();
//        dd($user);
        if (!$user || !password_verify($request->MatKhauCu, $user->MatKhau)){
            return redirect()->back()->withErrors("error", "Mật khẩu cũ không đúng");
        }

        if($request->MatKhauMoi != $request->MatKhauMoi2){
            return redirect()->back()->withErrors("error", "Mật khẩu nhập lại không khớp");
        }
        TaiKhoan::where('TenTaiKhoan', $request->session()->get('user.TenTaiKhoan'))->update([
            'MatKhau' => bcrypt($request->MatKhauMoi)
        ]);
        return view('auth.dangNhap');
    }

}
