<?php

namespace App\Http\Controllers;

use App\Models\ChuongTrinhGiamGia;
use App\Models\ChuongTrinhGiamGiaSP;
use App\Models\SanPham;
use App\Rules\KiemTraTGCTGG;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ChuongTrinhGiamGiaController extends Controller
{
    //
    public function giaoDienTao()
    {
        $products = SanPham::all();
        return view('admin.ChuongTrinhGiamGia.themChuongTrinhGiamGia', compact('products'));
    }

    public function taoChuongTrinhGiamGia(Request $request)
    {
//        dd($request);
        $validator = Validator::make($request->all(), [
            'TenCTGG' => 'required',
            'SlugCTGG' => ['required', 'unique:tbl_chuongtrinhgiamgia'],
            'HinhAnh' => ['required', 'image', 'mimes:jpeg,png,jpg,gif|max:2048'],
            'MoTa' => 'required',
            'MaSanPham' => 'required|array',
            'PhanTramGiam' => 'required',
            'ThoiGianKetThuc' => ['required','date','after:ThoiGianBatDau'],
            'ThoiGianBatDau' => [
                'required',
                'date',
                'after_or_equal:today',
                new KiemTraTGCTGG($request->ThoiGianBatDau, $request->ThoiGianKetThuc, $request->MaCTGG)],
        ], [
            'TenCTGG.required' => "Vui lòng nhập tên chương trình giảm giá.",
            'SlugCTGG.required' => "Vui lòng nhập slug.",
            'SlugCTGG.unique' => "Slug đã tồn tại.",
            'MoTa.required' => "Vui lòng nhập mô tả.",
            "MaSanPham.required" => "Vui lòng chọn sản phẩm",
            'PhanTramGiam.required' => "Vui lòng nhập phần trăm giảm",
            'HinhAnh.required' => 'Vui lòng nhập hình ảnh.',
            'HinhAnh.image' => 'Vui lòng chọn đúng định dạng file hình ảnh',
            'ThoiGianBatDau.required' => "Vui lòng chọn thời gian bắt đầu chương trình giảm giá có hiệu lực.",
            'ThoiGianBatDau.after_or_equal' => 'Thời gian bắt đầu phải ít nhất bắt đầu từ hôm nay.',
            'ThoiGianKetThuc.required' => "Vui lòng chọn thời gian kết thúc chương trình giảm giá.",
            'ThoiGianKetThuc.after' => 'Thời gian kết thúc phải sau ngày bắt đầu.',
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
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/ChuongTrinhGiamGia'), $imageName);
            $imagePath = 'upload/ChuongTrinhGiamGia/' . $imageName;
        }

        $trangThai = 0;
        if($request->TrangThai !== null){
            $trangThai = $request->TrangThai;
        }

//        dd($imagePath);
        // Lưu thông tin chương trình giảm giá vào cơ sở dữ liệu
        $discountProgram = ChuongTrinhGiamGia::create([
            'TenCTGG' => $request->TenCTGG,
            'SlugCTGG' => $request->SlugCTGG,
            'HinhAnh' => $imagePath,
            'MoTa' => $request->MoTa,
            'TrangThai' => $trangThai,
            'ThoiGianTao' => Carbon::now(), // Chèn giá trị ThoiGianTao
            'ThoiGianBatDau' => $request->ThoiGianBatDau,
            'ThoiGianKetThuc' => $request->ThoiGianKetThuc
        ]);
//            dd($discountProgram);

        // Lưu thông tin các sản phẩm liên quan
        foreach ($request->MaSanPham as $maSanPham) {
            ChuongTrinhGiamGiaSP::create([
                'MaCTGG' => $discountProgram->MaCTGG,
                'MaSanPham' => $maSanPham,
                'PhanTramGiam' => $request->PhanTramGiam,
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
        $discountPrograms = ChuongTrinhGiamGia::orderBy('MaCTGG', 'DESC')->paginate(5);

        // Trả về view và truyền dữ liệu chương trình giảm giá cho view
        return view('admin.ChuongTrinhGiamGia.lietKeChuongTrinhGiamGia', compact('discountPrograms'));
    }

    public function xoa($MaCT)
    {
        $discountProgram = ChuongTrinhGiamGia::findOrFail($MaCT);
        $discountProgram->TrangThai = 0;
        $discountProgram->save();
        return redirect()->route('/chuong-trinh-giam-gia')->with('success', 'Chương trình giảm giá đã được xóa thành công!');
    }

    public function giaoDienSua($MaCT)
    {
        $suaCT = ChuongTrinhGiamGia::with('chuongTrinhGiamGiaSPs.SanPham')->findOrFail($MaCT);
        $SanPham = SanPham::all();
        $ChuongTrinhGiamGiaSP = ChuongTrinhGiamGiaSP::where('MaCTGG', $MaCT)->get()->first();
//        dd($ChuongTrinhGiamGiaSP);
        return view('admin.ChuongTrinhGiamGia.suaChuongTrinhGiamGia', compact('suaCT', 'SanPham', 'ChuongTrinhGiamGiaSP'));
    }

    public function suaChuongTrinhGiamGia(Request $request, $MaCT)
    {
        $validator = Validator::make($request->all(), [
            'TenCTGG' => 'required',
            'SlugCTGG' => [
                'required',
                Rule::unique('tbl_chuongtrinhgiamgia', 'SlugCTGG')->ignore($MaCT, 'MaCTGG'),
            ],
            'HinhAnh' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif|max:2048'],
            'MoTa' => 'required',
            'TrangThai' => 'required',
            'MaSanPham' => 'required|array',
            'PhanTramGiam' => 'required',
//            'ThoiGianBatDau' => '',
//            'ThoiGianKetThuc' => ''
        ], [
            'TenCTGG.required' => "Vui lòng nhập tên chương trình giảm giá.",
            'SlugCTGG.required' => "Vui lòng nhập slug.",
            'SlugCTGG.unique' => "Slug đã tồn tại.",
            'MoTa.required' => "Vui lòng nhập mô tả.",
            'TrangThai.required' => "Vui lòng chọn trạng thái.",
            "MaSanPham.required" => "Vui lòng chọn sản phẩm",
            'PhanTramGiam.required' => "Vui lòng nhập phần trăm giảm",
            'HinhAnh.required' => 'Vui lòng nhập hình ảnh.',
            'HinhAnh.image' => 'Vui lòng chọn đúng định dạng file hình ảnh'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors());
        }

        $discountProgram = ChuongTrinhGiamGia::findOrFail($MaCT);

        if ($request->hasFile('HinhAnh')) {
            $path_unlink = $discountProgram->HinhAnh;
            if (file_exists($path_unlink)) {
                unlink($path_unlink);
            }
            $image = $request->file('HinhAnh');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/ChuongTrinhGiamGia'), $imageName);
            $discountProgram->HinhAnh = 'upload/ChuongTrinhGiamGia/' . $imageName;
        }

        $discountProgram->TenCTGG = $request->TenCTGG;
        $discountProgram->SlugCTGG = $request->SlugCTGG;
        $discountProgram->MoTa = $request->MoTa;
        $discountProgram->TrangThai = $request->TrangThai;
        $discountProgram->ThoiGianSua = Carbon::now();
        $discountProgram->ThoiGianBatDau = $request-> ThoiGianBatDau;
        $discountProgram->ThoiGianKetThuc = $request->ThoiGianKetThuc;
        $discountProgram->save();

//        dd($discountProgram->SanPham());

        // Cập nhật các sản phẩm trong chương trình giảm giá
        $discountProgram->chuongTrinhGiamGiaSPs()->delete(); // Xóa tất cả sản phẩm cũ
        foreach ($request->MaSanPham as $maSanPham) {
            ChuongTrinhGiamGiaSP::create([
                'MaCTGG' => $discountProgram->MaCTGG,
                'MaSanPham' => $maSanPham,
                'PhanTramGiam' => $request->PhanTramGiam,
            ]);
        }

        return redirect()->route('/chuong-trinh-giam-gia')->with('success', 'Chương trình giảm giá đã được cập nhật thành công!');
    }

    public function xemCT($MaCT)
    {
        $discountProgram = ChuongTrinhGiamGia::findOrFail($MaCT);
        return view('admin.ChuongTrinhGiamGia.xemCT', compact('discountProgram'));
    }

    public function list(Request $request)
    {
        $search = $request->input('search');
        $query = SanPham::query();

        if ($search) {
            $query->where('TenSanPham', 'like', "%{$search}%");
        }

        $sanphams = $query->select('MaSanPham', 'TenSanPham')->get();

        return response()->json($sanphams);
    }

    public function timKiem(Request $request)
    {
        //
        $discountPrograms = ChuongTrinhGiamGia::where('TenCTGG', 'LIKE', "%{$request->timKiem}%")
            ->orWhere('SlugCTGG', 'LIKE', "%{$request->timKiem}%")
            ->orWhere('MoTa', 'LIKE', "%{$request->timKiem}%")
            ->orWhere('ThoiGianTao', 'LIKE', "%{$request->timKiem}%")
//            ->orWhere('TrangThai', 'LIKE', "%{$request->timKiem}%")
//            ->orWhere('PhanTramGiam', 'LIKE', "%{$request->timKiem}%")
            ->get();
//        dd($phieuGiamGia);
        return view('admin.ChuongTrinhGiamGia.lietKeChuongTrinhGiamGia')->with(compact("discountPrograms"));

    }
}
