<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DatLaiMatKhau extends Controller
{
    public  function index()
    {
        return view('auth.datLaiMatKhau');
    }
    //
    public function datlaiMatKhau(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'MatKhauCu' => ['required', 'string', 'min:8'],
            'MatKhauMoi' => ['required', 'string'],
            'MatKhauMoi2' => ['required', 'string'],
        ],[
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

//        $user = TaiKhoan::where('TenTaiKhoan', $request->session()->get('user.TenTaiKhoan'))->first();
//        dd($user);
        if($request -> MatKhauMoi == $request -> MatKhauMoi2)
            TaiKhoan::where('TenTaiKhoan', $request->session()->get('user.TenTaiKhoan'))->update([
                'MatKhau' => bcrypt($request->MatKhauMoi)
            ]);
        return view('auth.dangNhap');
//        return redirect('/dang-nhap')->with('success', 'Tài khoản cập nhật mật khẩu thành công!');
//    $token = $user->first()->createToken('myapptoken')->plainTextToken;
//        $token = 1;
//        return new JsonResponse(
//            [
//                'success' => true,
//                'message' => "Your password has been reset",
////            'token'=>$token
//            ],
//            200
//        );
    }

}
