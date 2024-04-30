<?php

namespace App\Http\Controllers;

use App\Mail\DoiMatKhau;
use App\Models\TaiKhoan;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class QuenMatKhau extends Controller
{
    public  function indexQMK()
    {
        return view('auth.quenMatKhau');
    }

    public function indexXTPin()
    {
        return view('auth.xacThucPin');
    }
    //
    public function quenMatKhau(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Email' => ['required', 'string', 'Email', 'max:255'],
        ],[
            'Email.required' =>  "Vui lòng nhập Email.",
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors( $validator->errors());
//            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $verify = TaiKhoan::where('Email', $request->all()['Email'])->exists();

        if ($verify) {
            $verify2 = TaiKhoan::where('Email', $request -> Email)->first();

//        if ($verify2->exists()) {
//            $verify2->delete();
//        }

            $Pin = random_int(100000, 999999);
            $password_reset = DB::table('tbl_taikhoan')
                ->where(['Email' => $request->all()['Email'],])
                ->update([
//            'Email' => $request->all()['Email'],
                    'Pin' => $Pin,
                    'ThoiGianSua' => Carbon::now()
                ]);

            if ($password_reset) {
                $request->session()->put('user', [
                    'TenTaiKhoan' => $verify2 -> TenTaiKhoan,
                    'Quyen' => $verify2 -> Quyen,
                ]);
                Mail::to($request->all()['Email'])->send(new DoiMatKhau($Pin));
                return redirect('/xac-thuc-pin') -> with('success', 'Vui lòng kiểm tra email');
//                return new JsonResponse(
//                    [
//                        'success' => true,
//                        'message' => "Please check your Email for a 6 digit pin"
//                    ],
//                    200
//                );
            }
        } else {
//            return new JsonResponse(
//                [
//                    'success' => false,
//                    'message' => "This Email does not exist"
//                ],
//                400
//            );
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors( 'Email này không tồn tại.');
        }
    }

    public function xacThucPin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Pin' => ['required'],
        ],[
            'Pin.required' => "Vui lòng nhập mã pin",

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors( $validator->errors());
//            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $check = DB::table('tbl_taikhoan')
            ->where([
                'TenTaiKhoan' => $request->session()->get('user.TenTaiKhoan'),
                'Pin' => $request->all()['Pin'],
            ]);

        if ($check->exists()) {
            $difference = Carbon::now()->diffInSeconds($check->first()->ThoiGianSua);
            if ($difference > 3600) {
                return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors('Mã pin hết hiệu lực.');
//                return new JsonResponse(['success' => false, 'message' => "Pin Expired"], 400);
            }

//            $delete = DB::table('tbl_taikhoan')->where([
//                ['Email', $request->all()['Email']],
//                ['Pin', $request->all()['Pin']],
//            ])->delete();

//            return new JsonResponse(
//                [
//                    'success' => true,
//                    'message' => "You can now reset your password"
//                ],
//                200
//            );
            return redirect('/dat-lai-mat-khau');
        } else {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors('Mã pin không .');
//            return new JsonResponse(
//                [
//                    'success' => false,
//                    'message' => "Invalid Pin"
//                ],
//                401
//            );
        }
    }

}
