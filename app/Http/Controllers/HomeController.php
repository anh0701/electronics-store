<?php

namespace App\Http\Controllers;

use App\Models\ChuongTrinhGiamGia;
use App\Models\PhieuGiamGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\BaiViet;
use App\Models\DanhMucBaiViet;
use App\Models\ThuongHieu;
use App\Models\TaiKhoan;
use App\Models\PhanQuyen;
use App\Models\TinhThanhPho;
use App\Models\PhanQuyenNguoiDung;
use App\Models\ThuongHieuDanhMuc;
use App\Models\DanhMucTSKT;
use App\Models\ThongSoKyThuat;
use App\Models\SanPhamTSKT;
use App\Models\DanhGia;
use App\Models\ChuongTrinhGiamGia;
use App\Models\ChuongTrinhGiamGiaSP;
use App\Models\BinhLuan;

use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(){
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allSanPham = SanPham::orderBy('MaSanPham', 'DESC')->where('TrangThai', '1')->paginate(12);
        $allDanhGia = DanhGia::orderBy('MaDanhGia', 'DESC')->get();
        $allCTGG = ChuongTrinhGiamGia::orderBy('MaCTGG', 'DESC')->get();
        $allChiTietCTGG = ChuongTrinhGiamGiaSP::orderBy('MaCTGGSP', 'DESC')->get();
        $sanPhamNoiBat = SanPham::orderBy('MaSanPham', 'ASC')->take(20)->get();
        return view('pages.home')
        ->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham', 'allDanhGia', 'allCTGG', 'allChiTietCTGG', 'sanPhamNoiBat'));
    }

    public function HienThiDanhMucCha($MaDanhMuc){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allTHDM = ThuongHieuDanhMuc::orderBy('MaTHDM', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allDanhMucTSKT = DanhMucTSKT::orderBy('MaDMTSKT', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allTSKT = ThongSoKyThuat::orderBy('MaTSKT', 'DESC')->get();
        $allDanhGia = DanhGia::orderBy('MaDanhGia', 'DESC')->get();
        $sanPhamNoiBat = SanPham::orderBy('GiaSanPham', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->take(10)->get();


        $allDanhMucCon = '';
        foreach($allDanhMuc as $key =>$valueDanhMuc){
            if($valueDanhMuc->DanhMucCha != $MaDanhMuc){
                $allSanPham = SanPham::where('TrangThai', '1')->where('MaDanhMuc', $MaDanhMuc)->paginate(12);
            }else{
                $allDanhMucCon = DanhMuc::orderBy('MaDanhMuc', 'DESC')->where('MaDanhMuc', $valueDanhMuc['MaDanhMuc'])->get();
                foreach($allDanhMucCon as $key => $valueDanhMucCon){
                    $allSanPham = SanPham::where('TrangThai', '1')->where('MaDanhMuc', $valueDanhMucCon['MaDanhMuc'])->paginate(12);
                }
                return view('pages.SanPham.DanhMuc.HienThiDanhMucCha')
                ->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham', 'allTHDM', 'allDanhMucTSKT', 'allTSKT', 'MaDanhMuc'))
                ->with(compact('allDanhGia', 'sanPhamNoiBat'));
            }
        }

        return view('pages.SanPham.DanhMuc.HienThiDanhMucCha')
        ->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham', 'allTHDM', 'allDanhMucTSKT', 'allTSKT', 'MaDanhMuc'))
        ->with(compact('allDanhGia', 'sanPhamNoiBat'));
    }

    public function HienThiDanhMucCon($MaDanhMuc){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allSanPham = SanPham::orderBy('MaSanPham', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->where('TrangThai', '1')->paginate(12);
        $allTHDM = ThuongHieuDanhMuc::orderBy('MaTHDM', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allDanhMucTSKT = DanhMucTSKT::orderBy('MaDMTSKT', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allTSKT = ThongSoKyThuat::orderBy('MaTSKT', 'DESC')->get();
        $allDanhGia = DanhGia::orderBy('MaDanhGia', 'DESC')->get();
        return view('pages.SanPham.DanhMuc.HienThiDanhMucCon')
        ->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham', 'allDanhMucTSKT', 'allTSKT', 'allTHDM', 'MaDanhMuc'))
        ->with(compact('allDanhGia'));
    }

    public function HienThiSanPhamTheoTSKT($MaTSKT, $MaDanhMuc){
        $danhMucCha = $MaDanhMuc;
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $sanPhamThuocTSKT = SanPhamTSKT::orderBy('MaTSKT', 'DESC')->where('MaTSKT', $MaTSKT)->paginate('20');
        $allTHDM = ThuongHieuDanhMuc::orderBy('MaTHDM', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allDanhMucTSKT = DanhMucTSKT::orderBy('MaDMTSKT', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allTSKT = ThongSoKyThuat::orderBy('MaTSKT', 'DESC')->get();
        $ThongSoKyThuat = ThongSoKyThuat::where('MaTSKT', $MaTSKT)->first();
        $allDanhGia = DanhGia::orderBy('MaDanhGia', 'DESC')->get();
        return view('pages.SanPham.ThongSoKyThuat.HienThiSanPhamTheoTSKT')
        ->with(compact('allDanhMuc', 'allThuongHieu', 'sanPhamThuocTSKT', 'allDanhMucTSKT', 'allTSKT', 'allTHDM', 'MaDanhMuc', 'danhMucCha', 'ThongSoKyThuat'))
        ->with(compact('allDanhGia'));;
    }

    public function HienThiSanPhamTheoTH($MaThuongHieu, $MaDanhMuc){
        $danhMucCha = $MaDanhMuc;
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $sanPhamThuocThuongHieu = SanPham::orderBy('MaSanPham', 'DESC')->where('MaThuongHieu', $MaThuongHieu)->where('MaDanhMuc', $MaDanhMuc)->paginate('20');
        $allTHDM = ThuongHieuDanhMuc::orderBy('MaTHDM', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allDanhMucTSKT = DanhMucTSKT::orderBy('MaDMTSKT', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allTSKT = ThongSoKyThuat::orderBy('MaTSKT', 'DESC')->get();
        $thuongHieu = ThuongHieu::where('MaThuongHieu', $MaThuongHieu)->first();
        $allDanhGia = DanhGia::orderBy('MaDanhGia', 'DESC')->get();
        return view('pages.SanPham.ThuongHieu.HienThiSanPhamTheoTH')
        ->with(compact('allDanhMuc', 'allThuongHieu', 'sanPhamThuocThuongHieu', 'allDanhMucTSKT', 'allTSKT', 'allTHDM', 'MaDanhMuc', 'danhMucCha', 'thuongHieu'))
        ->with(compact('allDanhGia'));;
    }

    public function ChiTietSanPham($MaSanPham){
        $chiTietSanPham = SanPham::where('MaSanPham', $MaSanPham)->first();
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allSanPhamTSKT = SanPhamTSKT::orderBy('MaTSKTSP', 'DESC')->where('MaSanPham', $MaSanPham)->get();
        $allDanhGia = DanhGia::orderBy('MaDanhGia', 'DESC')->where('TrangThai', 1)->get();
        $allTaiKhoan = TaiKhoan::orderBy('MaTaiKhoan', 'DESC')->get();
        $rating = DanhGia::where('MaSanPham', $MaSanPham)->avg('SoSao');
        $rating = round($rating);
        $sanPhamLienQuan = SanPham::where('MaDanhMuc', $chiTietSanPham->MaDanhMuc)
        ->where('MaThuongHieu', $chiTietSanPham->MaThuongHieu)->whereNotIn('MaSanPham', [$MaSanPham])->take(4)->get();
        return view('pages.SanPham.ChiTietSanPham')
        ->with(compact('allDanhMuc', 'allThuongHieu', 'chiTietSanPham', 'allSanPhamTSKT', 'allDanhGia', 'allTaiKhoan'))
        ->with(compact('rating', 'sanPhamLienQuan'));
    }

    public function TimKiem(Request $request){
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->where('TrangThai', '1')->get();
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $keywords = $request->keywords_submit;

        if($keywords == ''){
            return Redirect::to('/');
        }

        $timKiemSanPham = SanPham::orderBy('MaDanhMuc', 'DESC')->where('TrangThai', '1')
        ->where('TenSanPham', 'like', '%'.$keywords.'%')->get();
        return view('pages.SanPham.TimKiem')
        ->with(compact('allDanhMuc', 'allThuongHieu', 'timKiemSanPham', 'keywords'))
        ->with(compact('allDanhGia'));
    }

    public function ThanhToan(){
        $allThanhPho = TinhThanhPho::orderBy('MaThanhPho', 'ASC')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allSanPham = SanPham::orderBy('MaDanhMuc', 'DESC')->where('TrangThai', '1')->paginate('20');
        return view('pages.ThanhToan.ThanhToan')->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham', 'allThanhPho'));
    }

    public function thongTinTaiKhoan(){
        $user = session(('user'));
        if ($user && isset($user['TenTaiKhoan'])) {
            $TenTaiKhoan = $user['TenTaiKhoan'];
            $tk = DB::select("SELECT * FROM tbl_taikhoan WHERE tbl_taikhoan.TenTaiKhoan = ?", [$TenTaiKhoan]);
//            dd($tk[0]->BacNguoiDung);
            $phieuGiamGia = PhieuGiamGia::where('BacNguoiDung', $tk[0]->BacNguoiDung)->orderBy('ThoiGianBatDau', 'DESC')->paginate('4');
        }
//        dd($phieuGiamGia);
        return view('auth.trangCaNhan')->with(compact( 'tk', 'phieuGiamGia'));
    }

    public function TrangKhachHangDangNhap(){
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allSanPham = SanPham::orderBy('MaDanhMuc', 'DESC')->where('TrangThai', '1')->paginate('20');
        return view('pages.TaiKhoan.login')->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham'));
    }

    public function KhachHangDangNhap(Request $request){
        $data = $request->all();
        $Email = $data['Email'];
        $MatKhau = md5($data['MatKhau']);
        $login = TaiKhoan::where('Email', $Email)->where('MatKhau', $MatKhau)->first();
        $isAdmin = 0;
        $phanQuyenNguoiDung = PhanQuyenNguoiDung::orderBy('MaPQND', 'DESC')->get();
        foreach($phanQuyenNguoiDung as $key => $value){
            if($value->MaTaiKhoan == $login->MaTaiKhoan){
                $isAdmin++;
            }
        }
        if($isAdmin > 1){
            Session::put('isAdmin', $isAdmin);
        }
        if($login){
            $login_count = $login->count();
            if($login_count){
                Session::put('MaTaiKhoan', $login->MaTaiKhoan);
                return Redirect::to('/');
            }
        }else{
            Session::put('status', 'Mật khẩu hoặc tài khoản không đúng. Vui lòng đăng nhập lại');
            return Redirect::to('/TrangKhachHangDangNhap');
        }
    }

    public function KhachHangDangXuat(){
        Session::put('TenTaiKhoan', null);
        Session::put('MaTaiKhoan', null);
        Session::put('isAdmin', null);
        return Redirect::to('/');
    }

    public function HienThiBaiViet(){
        $allBaiViet = BaiViet::orderBy('MaBaiViet', 'DESC')->orderBy('MaDanhMucBV', 'DESC')->paginate(15);
        $allDanhMucBV = DanhMucBaiViet::orderBy('MaDanhMucBV', 'DESC')->where('TrangThai', '1')->get();
        return view('pages.BaiViet.BaiViet')->with(compact('allBaiViet', 'allDanhMucBV'));
    }

    public function HienThiBaiVietTheoDMBV($MaDanhMucBV){
        $allBaiViet = BaiViet::orderBy('MaBaiViet', 'DESC')->where('MaDanhMucBV', $MaDanhMucBV)
        ->where('TrangThai', 1)->paginate(15);
        $allDanhMucBV = DanhMucBaiViet::orderBy('MaDanhMucBV', 'DESC')->where('TrangThai', '1')->get();
        return view('pages.BaiViet.BaiVietTheoDMBV')->with(compact('allBaiViet', 'allDanhMucBV'));
    }

    public function ChiTietBaiViet($MaBaiViet){
        $baiViet = BaiViet::where('MaBaiViet', $MaBaiViet)->first();
        $allDanhMucBV = DanhMucBaiViet::orderBy('MaDanhMucBV', 'DESC')->where('TrangThai', '1')->get();
        $allBinhLuan = BinhLuan::orderBy('MaBinhLuan', 'DESC')->where('MaBaiViet', $MaBaiViet)->where('TrangThai', 1)->get();
        $allTaiKhoan = TaiKhoan::orderBy('MaTaiKhoan', 'DESC')->get();
        return view('pages.BaiViet.ChiTietBaiViet')
        ->with(compact('baiViet', 'allDanhMucBV', 'allBinhLuan', 'allTaiKhoan'));
    }

    public function HienThiSanPhamTheoGiaTang($MaDanhMuc){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allSanPham = SanPham::orderBy('GiaSanPham')->where('MaDanhMuc', $MaDanhMuc)->where('TrangThai', '1')->paginate(12);
        $allTHDM = ThuongHieuDanhMuc::orderBy('MaTHDM', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allDanhMucTSKT = DanhMucTSKT::orderBy('MaDMTSKT', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allTSKT = ThongSoKyThuat::orderBy('MaTSKT', 'DESC')->get();
        $allDanhGia = DanhGia::orderBy('MaDanhGia', 'DESC')->get();

        return view('pages.SanPham.BoLoc.GiaCaoDenThap')
        ->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham', 'allDanhMucTSKT', 'allTSKT', 'allTHDM', 'MaDanhMuc'))
        ->with(compact('allDanhGia'));
    }

    public function HienThiSanPhamTheoGiaGiam($MaDanhMuc){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allSanPham = SanPham::orderBy('GiaSanPham', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->where('TrangThai', '1')->paginate(12);
        $allTHDM = ThuongHieuDanhMuc::orderBy('MaTHDM', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allDanhMucTSKT = DanhMucTSKT::orderBy('MaDMTSKT', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allTSKT = ThongSoKyThuat::orderBy('MaTSKT', 'DESC')->get();
        $allDanhGia = DanhGia::orderBy('MaDanhGia', 'DESC')->get();

        return view('pages.SanPham.BoLoc.GiaCaoDenThap')
        ->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham', 'allDanhMucTSKT', 'allTSKT', 'allTHDM', 'MaDanhMuc'))
        ->with(compact('allDanhGia'));
    }

    public function HienThiSanPhamTheoSoLuongBan($MaDanhMuc){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allSanPham = SanPham::orderBy('SoLuongBan', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->where('TrangThai', '1')->paginate(12);
        $allTHDM = ThuongHieuDanhMuc::orderBy('MaTHDM', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allDanhMucTSKT = DanhMucTSKT::orderBy('MaDMTSKT', 'DESC')->where('MaDanhMuc', $MaDanhMuc)->get();
        $allTSKT = ThongSoKyThuat::orderBy('MaTSKT', 'DESC')->get();
        $allDanhGia = DanhGia::orderBy('MaDanhGia', 'DESC')->get();

        return view('pages.SanPham.BoLoc.GiaCaoDenThap')
        ->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham', 'allDanhMucTSKT', 'allTSKT', 'allTHDM', 'MaDanhMuc'))
        ->with(compact('allDanhGia'));
    }

    public function product_tabs(Request $request){
        $data = $request->all();
        $output = '';
        $allDanhGia = DanhGia::orderBy('MaDanhGia', 'DESC')->get();
        $sanPhamThuocDM = SanPham::where('MaDanhMuc', $data['MaDanhMuc'])->orderBy('GiaSanPham', 'ASC')->take(5)->get();
        $soLuong = $sanPhamThuocDM->count();
        if($soLuong > 0){
            $output.='
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tshirt">';
                foreach($sanPhamThuocDM as $key => $sanPham){
                $output.='
                <div class="col-sm-15">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <form>
                                    '. csrf_field() .'
                                    <input type="hidden" value="'. $sanPham->MaSanPham .'" class="cart_product_id_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->TenSanPham .'" class="cart_product_name_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->HinhAnh .'" class="cart_product_image_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->GiaSanPham .'" class="cart_product_price_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ChieuCao .'" class="cart_product_height_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ChieuNgang .'" class="cart_product_width_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ChieuDay .'" class="cart_product_thick_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->CanNang .'" class="cart_product_weight_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ThoiGianBaoHanh .'" class="cart_product_guarantee_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="1" class="cart_product_qty_'. $sanPham->MaSanPham .'">
                                    <a href="'. route('/ChiTietSanPham', $sanPham->MaSanPham) .'">
                                        <img src="'. asset('upload/SanPham/'.$sanPham->HinhAnh) .'" alt="" />
                                        <p class="product-name">'. $sanPham->TenSanPham .'</p>
                                        <h2 class="">'.  number_format($sanPham->GiaSanPham,0,',','.').'₫'  .'</h2>
                                        <p class="vote-txt">
                                    ';
                                    $count = 0;
                                    $tongSoSao = 0;
                                        foreach($allDanhGia as $key => $danhGia){
                                            if($danhGia->MaSanPham == $sanPham->MaSanPham){
                                                $count++;
                                                $tongSoSao += $danhGia->SoSao;
                                            }
                                        }
                                        if($count > 0){
                                            $tongSoSao = $tongSoSao/$count;
                                            $output.='
                                            <b>'. number_format($tongSoSao, 1) .'</b>
                                            <i style="color:#FFCC36; margin-right: 5px" class="fa fa-star fa-fw"></i>
                                            <b>('. $count .')</b>
                                            ';
                                        }elseif($count == 0){
                                            $output.='
                                            <b>'. number_format($tongSoSao, 1) .'</b>
                                            <i style="color:#FFCC36; margin-right: 5px" class="fa fa-star fa-fw"></i>
                                            <b>(0)</b>
                                            ';
                                        }
                                $output.='
                                        </p>
                                    </a>
                                    <button type="button" class="btn btn-default add-to-cart ThemGioHang" 
                                    data-id_product="'. $sanPham->MaSanPham .'">
                                        <i class="fa fa-shopping-cart"></i>Thêm giỏ hàng
                                    </button>
                                </form>
                            </div>             
                        </div>
                    </div>
                </div>
                    ';}
            $output.='</div>
            </div>
            ';
        }else{
            // $output.='
            //     <div class="tab-content">
            //         <div class="tab-pane fade active in" id="tshirt" >
            //             <div class="col-sm-15">
            //                 <p>Hiện tại chưa có sản phẩm trong danh mục này</p>
            //             </div>
            //         </div>
            //     </div>
            // ';
            $output = 'abc xyz';
        }
        return $output;
    }
}
