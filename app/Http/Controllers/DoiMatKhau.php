<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoiMatKhau extends Controller
{
    //
    public function DoiMatKhau(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Email' => ['required', 'string', 'Email', 'max:255'],
            'MatKhau' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $user = TaiKhoan::where('Email', $request->Email);
        $user->update([
            'MatKhau' => bcrypt($request->MatKhau)
        ]);

//    $token = $user->first()->createToken('myapptoken')->plainTextToken;
//        $token = 1;
        return new JsonResponse(
            [
                'success' => true,
                'message' => "Your password has been reset",
//            'token'=>$token
            ],
            200
        );
    }

}
