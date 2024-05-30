<?php

namespace App\Http\Controllers;

use App\Models\ChuongTrinhGiamGia;
use App\Models\ChuongTrinhGiamGiaSP;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Rules\KiemTraTGCTGG;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Session;

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

    public function Test(){
        // $chuongTrinhGiamGia = Session('chuongTrinhGiamGia');
        // foreach(Session('chuongTrinhGiamGia') as $key => $value)
        echo '<pre>';
        print_r(Session('chuongTrinhGiamGia'));
        echo '</pre>';
        // Session()->forget('cart');
        // Session()->forget('sanPham');
    }

    public function TrangThemCTGG(){
        return view('admin.ChuongTrinhGiamGia.ThemCTGG');
    }

    public function HienThiSanPham(Request $request){
        $data = $request->all();
        $allSanPham = SanPham::orderBy('MaSanPham', 'DESC')->orderBy('MaDanhMuc', 'DESC')->paginate(20);
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        if(Empty($data['DanhMucCha'])){
            return redirect()->route('/TrangThemCTGGSP')->with('status', 'Hãy chọn danh mục trước khi hiển thị sản phẩm');
        }elseif( $data['DanhMucCha'] && Empty($data['DanhMucCon'])){
            $maDanhMuc = $data['DanhMucCha'];
            $allSanPham = SanPham::orderBy('MaSanPham', 'DESC')->orderBy('MaDanhMuc', 'DESC')->where('MaDanhMuc', $maDanhMuc)->paginate(20);
            return view('admin.ChuongTrinhGiamGia.ThemCTGGSP')->with(compact('allSanPham', 'allDanhMuc', 'maDanhmuc'));
        }elseif( $data['DanhMucCha'] && $data['DanhMucCon']){
            $maDanhMuc = $data['DanhMucCon'];
            $allSanPham = SanPham::orderBy('MaSanPham', 'DESC')->orderBy('MaDanhMuc', 'DESC')->where('MaDanhMuc', $maDanhMuc)->paginate(20);
            return view('admin.ChuongTrinhGiamGia.ThemCTGGSP')->with(compact('allSanPham', 'allDanhMuc', 'maDanhMuc'));
        }
    }

    public function TrangThemCTGGSP(){
        $maDanhmuc = '';
        $allSanPham = SanPham::orderBy('MaSanPham', 'DESC')->orderBy('MaDanhMuc', 'DESC')->paginate(20);
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        return view('admin.ChuongTrinhGiamGia.ThemCTGGSP')->with(compact('allSanPham', 'allDanhMuc', 'maDanhmuc'));
    }

    public function ThemCTGGVaoSession(Request $request){
        $data = $request->validate([
            'TenCTGG' => 'required',
            'SlugCTGG' => 'required',
            'MoTa' => 'required',
            'TrangThai' => 'required',
            'ThoiGianKetThuc' => 'required',
            'ThoiGianBatDau' => 'required',
        ],
        [
            'TenCTGG.required' => "Vui lòng nhập tên chương trình giảm giá.",
            'SlugCTGG.required' => "Vui lòng nhập slug.",
            'MoTa.required' => "Vui lòng nhập mô tả.",
            'ThoiGianBatDau.required' => "Vui lòng chọn thời gian bắt đầu chương trình giảm giá có hiệu lực.",
            'ThoiGianKetThuc.required' => "Vui lòng chọn thời gian kết thúc chương trình giảm giá.",
            'TrangThai.required' => "Trạng thái đang trống",
        ]);
        $order_code = substr(md5(microtime()), rand(0, 26), 5);

        $chuongTrinhGiamGia[] = array(
            'TenCTGG' => $data['TenCTGG'],
            'SlugCTGG' => $data['SlugCTGG'],
            'order_code' => $order_code,
            'MoTa' => $data['MoTa'],
            'TrangThai' => $data['TrangThai'],
            'ThoiGianBatDau' => $data['ThoiGianBatDau'],
            'ThoiGianKetThuc' => $data['ThoiGianKetThuc'],
        );
        Session::put('chuongTrinhGiamGia', $chuongTrinhGiamGia);
        Session::save();
        //$this->TrangThemCTGGSP();
        return Redirect()->route('/TrangThemCTGGSP');
    }

    public function ThemSanPhamVaoSession($MaSanPham){
        // echo '<pre>';
        // print_r($MaSanPham);
        // echo '</pre>';
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $sanPham = Session::get('sanPham');
        if($sanPham == true){
            $is_avaiable = 0;
            foreach($sanPham as $key => $value){
                if($value['MaSanPham'] == $MaSanPham){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $sanPham[] = array(
                    'session_id' => $session_id,
                    'MaSanPham' => $MaSanPham,
                    'PhanTramGiam' => 1,
                );
                Session::put('sanPham', $sanPham);
            }
        }else{
            $sanPham[] = array(
                'session_id' => $session_id,
                'MaSanPham' => $MaSanPham,
                'PhanTramGiam' => 1,
            );
            Session::put('sanPham', $sanPham);
            Session::save();
        }
        return Redirect()->route('/TrangThemCTGGSP')->with('status', 'Thêm sản phẩm vào chương trình giảm giá thành công');
    }

    public function XoaSanPhamKhoiSession($session_id){
        $sanPham = Session::get('sanPham');
        if($sanPham == true){
            foreach($sanPham as $key => $value){
                if($value['session_id'] == $session_id){
                    unset($sanPham[$key]);
                }
            }
            Session::put('sanPham', $sanPham);
            return Redirect()->back()->with('message', 'Xóa sản phẩm khỏi chương trình giảm giá thành công');
        }else{
            return Redirect()->back()->with('message', 'Xóa sản phẩm khỏi chương trình giảm giá thất bại');
        }
    }

    public function SuaPhanTramGiamSanPham($session_id, Request $request){
        $data = $request->all();
        $sanPham = Session::get('sanPham');
        if($sanPham == true){
            foreach($sanPham as $session => $value){
                if($value['session_id'] == $session_id){
                    $sanPham[$session]['PhanTramGiam'] = $data['PhanTramGiam'];
                }
            }
            Session::put('sanPham', $sanPham);
            return Redirect()->back();
        }else{
            return Redirect()->back();
        }
    }

    public function ThemCTGG(Request $request){
        $data = $request->all();

        $valueCTGG = new ChuongTrinhGiamGia();
        $order_code = '';
        foreach(Session('chuongTrinhGiamGia') as  $key => $chuongTrinhGiamGia){
            $order_code = $chuongTrinhGiamGia['order_code'];
            $valueCTGG->TenCTGG = $chuongTrinhGiamGia['TenCTGG'];
            $valueCTGG->SlugCTGG = $chuongTrinhGiamGia['SlugCTGG'];
            $valueCTGG->order_code = $chuongTrinhGiamGia['order_code'];
            $valueCTGG->MoTa = $chuongTrinhGiamGia['MoTa'];
            $valueCTGG->TrangThai = $chuongTrinhGiamGia['TrangThai'];
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $valueCTGG->ThoiGianTao = now();
            $valueCTGG->ThoiGianBatDau = $chuongTrinhGiamGia['ThoiGianBatDau'];
            $valueCTGG->ThoiGianKetThuc = $chuongTrinhGiamGia['ThoiGianKetThuc'];
        }

        $get_image = $request->HinhAnh;
        $path = 'upload/ChuongTrinhGiamGia/';
        $get_name_image = $get_image->getClientOriginalName(); 
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $valueCTGG->HinhAnh = $new_image;
        $valueCTGG->save();

        foreach(Session('sanPham') as $key => $value){
            $valueCTGGSP = new ChuongTrinhGiamGiaSP();
            $valueCTGGSP->order_code = $order_code;
            $valueCTGGSP->MaSanPham = $value['MaSanPham'];
            $valueCTGGSP->PhanTramGiam = $value['PhanTramGiam'];
            $valueCTGGSP->save();
        }
        Session::forget('chuongTrinhGiamGia');
        Session::forget('sanPham');
        return Redirect()->back()->with('message', 'Tạo mới 1 chương trình giảm giá thành công');
    }

}
