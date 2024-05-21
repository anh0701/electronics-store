<?php

namespace App\Http\Controllers;

use App\Models\ChuongTrinhGiamGiaSP;
use App\Models\ChuongTrinhGiamGia;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ChuongTrinhGiamGiaController extends Controller
{
    //
    public function giaoDienTao (){
        $products = SanPham::all();
        return view('admin.ChuongTrinhGiamGia.themChuongTrinhGiamGia', compact('products'));
    }

    public function taoChuongTrinhGiamGia (Request $request){
//        dd($request);
        $validator = Validator::make($request->all(),[
            'TenCTGG' => 'required',
            'SlugCTGG' => ['required', 'unique:tbl_chuongtrinhgiamgia'],
            'HinhAnh' => ['required', 'image','mimes:jpeg,png,jpg,gif|max:2048'],
            'MoTa' => 'required',
            'TrangThai' => 'required',
            'MaSanPham' => 'required|array',
            'PhanTramGiam' => 'required',
        ],[
            'TenCTGG.required' =>"Vui lòng nhập tên chương trình giảm giá.",
            'SlugCTGG.required' => "Vui lòng nhập slug.",
            'SlugCTGG.unique' => "Slug đã tồn tại.",
            'MoTa.required' => "Vui lòng nhập mô tả.",
            'TrangThai.required' => "Vui lòng chọn trạng thái.",
            "MaSanPham.required" => "Vui lòng chọn sản phẩm",
            'PhanTramGiam.required' => "Vui lòng nhập phần trăm giảm",
            'HinhAnh.required' =>'Vui lòng nhập hình ảnh.',
            'HinhAnh.image' => 'Vui lòng chọn đúng định dạng file hình ảnh'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors());
        }

        $imagePath = null;
        // Xử lý upload hình ảnh
        $imagePath = null;
        if ($request->hasFile('HinhAnh')) {
            $image = $request->file('HinhAnh');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/ChuongTrinhGiamGia'), $imageName);
            $imagePath = 'uploads/ChuongTrinhGiamGia/'.$imageName;
        }
//        dd($imagePath);
        // Lưu thông tin chương trình giảm giá vào cơ sở dữ liệu
        $discountProgram = ChuongTrinhGiamGia::create([
            'TenCTGG' => $request->TenCTGG,
            'SlugCTGG' => $request->SlugCTGG,
            'HinhAnh' => $imagePath,
            'MoTa' => $request->MoTa,
            'TrangThai' => $request->TrangThai,
            'ThoiGianTao' => Carbon::now(), // Chèn giá trị ThoiGianTao
        ]);
//            dd($discountProgram);

        // Lưu thông tin các sản phẩm liên quan
        foreach ($request->MaSanPham as $maSanPham) {
            ChuongTrinhGiamGiaSP::create([
                'MaCTGG' => $discountProgram->MaCTGG,
                'MaSanPham' => $maSanPham,
                'PhamTramGiam' => $request->PhamTramGiam,
            ]);
        }

        return redirect()->route('/chuong-trinh-giam-gia')->with('success', 'Discount program created successfully!');
    }
    public function danhSachSanPham(Request $request)
    {
        $search = $request->input('q');
        $ids = $request->input('ids');

        if ($ids) {
            $products = SanPham::whereIn('MaSanPham', $ids)->get(['MaSanPham as id', 'TenSanPham as text']);
            return response()->json($products);
        }

        $products = SanPham::where('TenSanPham', 'LIKE', "%{$search}%")
            ->get(['MaSanPham as id', 'TenSanPham as text']);

        return response()->json($products);
    }

    public function giaoDienLietKe()
    {
        // Lấy tất cả các chương trình giảm giá từ cơ sở dữ liệu
        $discountPrograms = ChuongTrinhGiamGia::orderBy('MaCTGG', 'DESC')->paginate(5);;

        // Trả về view và truyền dữ liệu chương trình giảm giá cho view
        return view('admin.ChuongTrinhGiamGia.lietKeChuongTrinhGiamGia', compact('discountPrograms'));
    }

    public function xoa()
    {

    }

    public function giaoDienSua($MaCT)
    {
        $suaCT = ChuongTrinhGiamGia::find($MaCT);
//        dd($MaCT);
//        dd($suaCT);
//        ddd($suaCT);
        return view('admin.ChuongTrinhGiamGia.suaChuongTrinhGiamGia', compact('suaCT'));
    }

    public function suaChuongTrinhGiamGia(Request $request,$MaCT)
    {
        $validator = Validator::make($request->all(),[

        ]);
    }
}
