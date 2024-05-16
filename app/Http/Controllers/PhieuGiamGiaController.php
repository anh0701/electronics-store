<?php

namespace App\Http\Controllers;

use App\Models\PhieuGiamGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PhieuGiamGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function phieuGiamGia()
    {
        //
        $phieuGiamGia = PhieuGiamGia::orderBy('MaGiamGia', 'DESC')->paginate(5);
        return view('admin.PhieuGiamGia.lietKePhieuGiamGia')->with(compact("phieuGiamGia"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function giaoDienTao()
    {
        //
        return view('admin.PhieuGiamGia.themPhieuGiamGia');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function taoPhieuGiamGia(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'TenMaGiamGia' => ['required', 'string', 'max:255'],
            'SlugMaGiamGia' => ['required', 'string', 'max:255'],
            'TriGia' => ['required', 'integer'],
            'MaCode' => ['required', 'string'],
            'DonViTinh' => ['required', 'integer'],
        ], [
            'TenMaGiamGia.required' => "Vui lòng nhập tên phiếu giảm giá.",
            'SlugMaGiamGia.required' => "Vui lòng nhập slug phiếu giảm giá.",
            'TriGia.required' => "Vui lòng nhập trị giá phiếu giảm giá.",
            'MaCode.required' => "Vui lòng nhập mã code của phiếu giảm giá.",
            'DonViTinh.required' => "Vui lòng nhập đơn vị tính của phiếu giảm giá.",
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors());
        }
        $data = $request->all();
        $phieu = new PhieuGiamGia();
        $phieu->TenMaGiamGia = $data['TenMaGiamGia'];
        $phieu->SlugMaGiamGia = $data['SlugMaGiamGia'];
        $phieu->TriGia = $data['TriGia'];
        $phieu->MaCode = $data['MaCode'];
        $phieu->DonViTinh = $data['DonViTinh'];
        $phieu->save();

        return Redirect::to('/liet-ke-phieu-giam-gia')->with('message', 'Thêm mã giảm giá thành công');

    }

    /**
     * Display the specified resource.
     */
    public function timKiem(Request $request)
    {
        //
        $phieuGiamGia = PhieuGiamGia::where('TenMaGiamGia', 'LIKE', "%{$request->timKiem}%")
            ->orWhere('SlugMaGiamGia', 'LIKE', "%{$request->timKiem}%")
            ->orWhere('TriGia', 'LIKE', "%{$request->timKiem}%")
            ->orWhere('MaCode', 'LIKE', "%{$request->timKiem}%")
            ->orWhere('DonViTinh', 'LIKE', "%{$request->timKiem}%")
            ->get();
//        dd($phieuGiamGia);
        return view('admin.PhieuGiamGia.lietKePhieuGiamGia')->with(compact("phieuGiamGia"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function giaoDienSua($MaGiamGia)
    {
        //
        $suaPhieu = PhieuGiamGia::where('MaGiamGia', $MaGiamGia)->get();
        return view('admin.PhieuGiamGia.suaPhieuGiamGia', compact('suaPhieu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function suaPhieuGiamGia(Request $request, $MaGiamGia)
    {
        $validator = Validator::make($request->all(), [
            'TenMaGiamGia' => ['required', 'string', 'max:255'],
            'SlugMaGiamGia' => ['required', 'string', 'max:255'],
            'TriGia' => ['required', 'integer'],
            'MaCode' => ['required', 'string'],
            'DonViTinh' => ['required', 'integer'],
        ], [
            'TenMaGiamGia.required' => "Vui lòng nhập tên phiếu giảm giá.",
            'SlugMaGiamGia.required' => "Vui lòng nhập slug phiếu giảm giá.",
            'TriGia.required' => "Vui lòng nhập trị giá phiếu giảm giá.",
            'MaCode.required' => "Vui lòng nhập mã code của phiếu giảm giá.",
            'DonViTinh.required' => "Vui lòng nhập đơn vị tính của phiếu giảm giá.",
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors());
        }
//        $data = $request->all();
//        dd($data);
        $phieu = PhieuGiamGia::find($MaGiamGia);
//        dd($phieu);
        $phieu->TenMaGiamGia = $request->TenMaGiamGia;
        $phieu->SlugMaGiamGia = $request->SlugMaGiamGia;
        $phieu->TriGia = $request->TriGia;
        $phieu->MaCode = $request->MaCode;
        $phieu->DonViTinh = $request->DonViTinh;
        $phieu->save();

        return Redirect::to('/liet-ke-phieu-giam-gia')->with('message', 'Sửa mã giảm giá thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function Xoa($MaGiamGia)
    {
        //
        $phieuGiamGia = PhieuGiamGia::find($MaGiamGia);
        $phieuGiamGia->delete();
        return Redirect::to('liet-ke-phieu-giam-gia')->with('status', 'Xóa mã giảm giá thành công');

    }
}
