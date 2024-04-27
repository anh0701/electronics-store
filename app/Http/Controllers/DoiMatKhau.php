<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
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

    $user = TaiKhoan::where('Email',$request->Email);
    $user->update([
        'MatKhau'=>md5($request->MatKhau)
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
