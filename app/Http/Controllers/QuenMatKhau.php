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
    //
    public function QuenMatKhau(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Email' => ['required', 'string', 'Email', 'max:255'],
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $verify = TaiKhoan::where('Email', $request->all()['Email'])->exists();

        if ($verify) {
            $verify2 = DB::table('tbl_taikhoan')->where([
                ['Email', $request->all()['Email']]
            ]);

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
                Mail::to($request->all()['Email'])->send(new DoiMatKhau($Pin));

                return new JsonResponse(
                    [
                        'success' => true,
                        'message' => "Please check your Email for a 6 digit pin"
                    ],
                    200
                );
            }
        } else {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => "This Email does not exist"
                ],
                400
            );
        }
    }

    public function XacThucPin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Email' => ['required', 'string', 'Email', 'max:255'],
            'Pin' => ['required'],
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $check = DB::table('tbl_taikhoan')
            ->where([
                'Email' => $request->all()['Email'],
                'Pin' => $request->all()['Pin'],
            ]);

        if ($check->exists()) {
            $difference = Carbon::now()->diffInSeconds($check->first()->ThoiGianSua);
            if ($difference > 3600) {
                return new JsonResponse(['success' => false, 'message' => "Pin Expired"], 400);
            }

//            $delete = DB::table('tbl_taikhoan')->where([
//                ['Email', $request->all()['Email']],
//                ['Pin', $request->all()['Pin']],
//            ])->delete();

            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "You can now reset your password"
                ],
                200
            );
        } else {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => "Invalid Pin"
                ],
                401
            );
        }
    }

}
