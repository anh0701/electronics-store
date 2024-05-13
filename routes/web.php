<?php

use App\Http\Controllers\NhaCungCapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhieuNhapController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\ThuongHieuController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DanhMucTSKTController;
use App\Http\Controllers\ThongSoKyThuatController;
use App\Http\Controllers\SanPhamTSKTController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\PhiGiaoHangController;
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\DatLaiMatKhau;
use App\Http\Controllers\DoiMatKhau;
use App\Http\Controllers\QuenMatKhau;


// Trang admin

// Phieu Nhap


//Nha cung cap
Route::get('/liet-ke-nha-cung-cap', [NhaCungCapController::class, 'lietKe'])->name('lietKeNCC');
Route::get('/them-nha-cung-cap', [NhaCungCapController::class, 'themNCC'])->name('themNCC');
Route::post('/xuLyThemNCC', [NhaCungCapController::class, 'xuLyThemNCC']);
Route::get('/sua-nha-cung-cap/{id}', [NhaCungCapController::class, 'suaNCC'])->name('suaNCC');
Route::post('/xuLySuaNCC', [NhaCungCapController::class, 'xuLySuaNCC'])->name('xuLySuaNCC');
Route::get('/xoa-nha-cung-cap/{id}', [NhaCungCapController::class, 'xoaNCC'])->name('xoaNCC');

// Thuong Hieu San Pham
Route::get('/xemPN', [PhieuNhapController::class, 'trangXemPhieuNhap']);
Route::get('/xemCTPN/{id}', [PhieuNhapController::class, 'xemCTPN'])->name('xem.CT');
Route::get('/lapPN', [PhieuNhapController::class, 'lapPN'])->name('lapPN');
Route::post('/xuLyLapPN', [PhieuNhapController::class, 'luuPN']);
Route::get('/suaPN/{id}', [PhieuNhapController::class, 'suaPN'])->name('suaPN');
Route::post('/xuLySuaPN', [PhieuNhapController::class, 'xuLySua'])->name('xuLySuaPN');

// Thuong Hieu San Pham
Route::get('/TrangThemThuongHieu', [ThuongHieuController::class, 'TrangThemThuongHieu'])->name('/TrangThemThuongHieu');
Route::get('/TrangLietKeThuongHieu', [ThuongHieuController::class, 'TrangLietKeThuongHieu'])->name('/TrangLietKeThuongHieu');
Route::post('/ThemThuongHieu', [ThuongHieuController::class, 'ThemThuongHieu'])->name('/ThemThuongHieu');
Route::get('/KichHoatThuongHieu/{MaThuongHieu}', [ThuongHieuController::class, 'KichHoatThuongHieu'])->name('/KichHoatThuongHieu');
Route::get('/KoKichHoatThuongHieu/{MaThuongHieu}', [ThuongHieuController::class, 'KoKichHoatThuongHieu'])->name('/KoKichHoatThuongHieu');
Route::get('/TrangSuaThuongHieu/{MaThuongHieu}', [ThuongHieuController::class, 'TrangSuaThuongHieu'])->name('/TrangSuaThuongHieu');
Route::get('/XoaThuongHieu/{MaThuongHieu}', [ThuongHieuController::class, 'XoaThuongHieu'])->name('/XoaThuongHieu');
Route::post('/SuaThuongHieu/{MaThuongHieu}', [ThuongHieuController::class, 'SuaThuongHieu'])->name('/SuaThuongHieu');

//TaiKhoan
Route::get('/dang-nhap', [TaiKhoanController::class, 'dangNhap'])->name('dangNhap');
Route::post('/xuLyDN', [TaiKhoanController::class, 'xuLyDN']);
Route::get('/trang-quan-ly', [TaiKhoanController::class, 'trangAdmin'])->name('trangAdmin')->middleware('DangNhap');
Route::get('/dangXuat', [TaiKhoanController::class, 'dangXuat'])->name('dangXuat');
Route::get('/dang-ky', [TaiKhoanController::class, 'dangKy'])->name('dangKy');
Route::post('/xu-ly-dang-ky', [TaiKhoanController::class, 'xuLyDK'])->name('xuLyDK');
Route::get('/liet-ke-tai-khoan', [TaiKhoanController::class, 'lietKeTK'])->name('lietKeTK');
Route::get('/tao-tai-khoan', [TaiKhoanController::class, 'taoTK'])->name('taoTK');
Route::post('/xuLyTaoTK', [TaiKhoanController::class, 'xuLyTaoTK'])->name('xuLyTaoTK');
Route::get('/sua-tai-khoan/{id}', [TaiKhoanController::class, 'suaTK'])->name('suaTK');
Route::post('/xuLySuaTK', [TaiKhoanController::class, 'xuLySuaTK'])->name('xuLySuaTK');
Route::get('/xoaTK/{id}', [TaiKhoanController::class, 'xoaTK'])->name('xoaTK');
Route::post('/doi-mat-khau', [DoiMatKhau::class, 'doiMatKhau'])->name('doiMatKhau');
Route::get('/doi-mat-khau', [DoiMatKhau::class, 'index'])->name('indexDMK');
Route::post('/dat-lai-mat-khau', [DatLaiMatKhau::class, 'datLaiMatKhau'])->name('datLaiMatKhau');
Route::get('/dat-lai-mat-khau', [DatLaiMatKhau::class, 'index'])->name('indexDLMK');
Route::post('/quen-mat-khau', [QuenMatKhau::class, 'quenMatKhau'])->name('quenMatKhau');
Route::get('/quen-mat-khau', [QuenMatKhau::class, 'indexQMK'])->name('indexQMK');
Route::post('/xac-thuc-pin', [QuenMatKhau::class, 'xacThucPin'])->name('xacThucPin');
Route::get('/xac-thuc-pin', [QuenMatKhau::class, 'indexXTPin'])->name('indexXTPin');

// 
Route::get('/dashboard', [TaiKhoanController::class, 'dashboard'])->name('dashboard');

// Danh muc
Route::get('/TrangThemDanhMuc', [DanhMucController::class, 'TrangThemDanhMuc'])->name('/TrangThemDanhMuc');
Route::get('/TrangLietKeDanhMuc', [DanhMucController::class, 'TrangLietKeDanhMuc'])->name('/TrangLietKeDanhMuc');
Route::post('/ThemDanhMuc', [DanhMucController::class, 'ThemDanhMuc'])->name('/ThemDanhMuc');
Route::get('/KichHoatDanhMuc/{MaDanhMuc}', [DanhMucController::class, 'KichHoatDanhMuc'])->name('/KichHoatDanhMuc');
Route::get('/KoKichHoatDanhMuc/{MaDanhMuc}', [DanhMucController::class, 'KoKichHoatDanhMuc'])->name('/KoKichHoatDanhMuc');
Route::get('/TrangSuaDanhMuc/{MaDanhMuc}', [DanhMucController::class, 'TrangSuaDanhMuc'])->name('/TrangSuaDanhMuc');
Route::get('/XoaDanhMuc/{MaDanhMuc}', [DanhMucController::class, 'XoaDanhMuc'])->name('/XoaDanhMuc');
Route::post('/SuaDanhMuc/{MaDanhMuc}', [DanhMucController::class, 'SuaDanhMuc'])->name('/SuaDanhMuc');

// Thương hiệu thuộc danh mục
Route::get('/trang-them-thdm', [DanhMucController::class, 'trangThemTHDM'])->name('/trang-them-thdm');
Route::post('/them-thdm', [DanhMucController::class, 'themTHDM'])->name('/them-thdm');
Route::get('/trang-liet-ke-thtdm', [DanhMucController::class, 'trangLietKeTHDM'])->name('/trang-liet-ke-thtdm');
Route::get('/xoa-thdm/{MaTHDM}', [DanhMucController::class, 'xoaTHDM'])->name('/xoa-thdm');
Route::get('/trang-sua-thdm//{MaTHDM}', [DanhMucController::class, 'trangSuaTHDM'])->name('/trang-sua-thdm');
Route::post('/sua-thdm/{MaTHDM}', [DanhMucController::class, 'suaTHDM'])->name('/sua-thdm');

// Danh mục TSKT
Route::get('/TrangThemDanhMucTSKT', [DanhMucTSKTController::class, 'TrangThemDanhMucTSKT'])->name('/TrangThemDanhMucTSKT');
Route::get('/TrangLietKeDanhMucTSKT', [DanhMucTSKTController::class, 'TrangLietKeDanhMucTSKT'])->name('/TrangLietKeDanhMucTSKT');
Route::post('/ThemDanhMucTSKT', [DanhMucTSKTController::class, 'ThemDanhMucTSKT'])->name('/ThemDanhMucTSKT');
Route::get('/TrangSuaDanhMucTSKT/{MaDMTSKT}', [DanhMucTSKTController::class, 'TrangSuaDanhMucTSKT'])->name('/TrangSuaDanhMucTSKT');
Route::post('/SuaDanhMucTSKT/{MaDMTSKT}', [DanhMucTSKTController::class, 'SuaDanhMucTSKT'])->name('/SuaDanhMucTSKT');
Route::get('/XoaDanhMucTSKT/{MaDMTSKT}', [DanhMucTSKTController::class, 'XoaDanhMucTSKT'])->name('/XoaDanhMucTSKT');

// TSKT
Route::get('/TrangThemTSKT', [ThongSoKyThuatController::class, 'TrangThemTSKT'])->name('/TrangThemTSKT');
Route::get('/TrangLietKeTSKT', [ThongSoKyThuatController::class, 'TrangLietKeTSKT'])->name('/TrangLietKeTSKT');
Route::post('/ThemTSKT', [ThongSoKyThuatController::class, 'ThemTSKT'])->name('/ThemTSKT');
Route::get('/TrangSuaTSKT/{MaTSKT}', [ThongSoKyThuatController::class, 'TrangSuaTSKT'])->name('/TrangSuaTSKT');
Route::post('/SuaTSKT/{MaTSKT}', [ThongSoKyThuatController::class, 'SuaTSKT'])->name('/SuaTSKT');
Route::get('/XoaTSKT/{MaTSKT}', [ThongSoKyThuatController::class, 'XoaTSKT'])->name('/XoaTSKT');
Route::post('/ChonDanhMucTSKT', [ThongSoKyThuatController::class, 'ChonDanhMucTSKT'])->name('/ChonDanhMucTSKT');

// sản phẩm
Route::get('/TrangThemSanPham', [SanPhamController::class, 'TrangThemSanPham'])->name('/TrangThemSanPham');
Route::get('/TrangLietKeSanPham', [SanPhamController::class, 'TrangLietKeSanPham'])->name('/TrangLietKeSanPham');
Route::post('/ThemSanPham', [SanPhamController::class, 'ThemSanPham'])->name('/ThemSanPham');
Route::get('/KichHoatSanPham/{MaSanPham}', [SanPhamController::class, 'KichHoatSanPham'])->name('/KichHoatSanPham');
Route::get('/KoKichHoatSanPham/{MaSanPham}', [SanPhamController::class, 'KoKichHoatSanPham'])->name('/KoKichHoatSanPham');
Route::get('/TrangSuaSanPham/{MaSanPham}', [SanPhamController::class, 'TrangSuaSanPham'])->name('/TrangSuaSanPham');
Route::get('/XoaSanPham/{MaSanPham}', [SanPhamController::class, 'XoaSanPham'])->name('/XoaSanPham');
Route::post('/SuaSanPham/{MaSanPham}', [SanPhamController::class, 'SuaSanPham'])->name('/SuaSanPham');
Route::post('/ThemTSKTChoSanPham', [SanPhamController::class, 'ThemTSKTChoSanPham'])->name('/ThemTSKTChoSanPham');
Route::get('/TrangSanPhamTSKT/{MaSanPham}', [SanPhamController::class, 'TrangSanPhamTSKT'])->name('/TrangSanPhamTSKT');
Route::post('/SuaSanPhamTSKT/{MaTSKTSP}/{MaTSKT}', [SanPhamController::class, 'SuaSanPhamTSKT'])->name('/SuaSanPhamTSKT');

// Phí giao hàng
Route::get('/TrangThemPhiGiaoHang', [PhiGiaoHangController::class, 'TrangThemPhiGiaoHang'])->name('/TrangThemPhiGiaoHang');
Route::get('/TrangLietKePhiGiaoHang', [PhiGiaoHangController::class, 'TrangLietKePhiGiaoHang'])->name('/TrangLietKePhiGiaoHang');
Route::post('/ThemPhiGiaoHang', [PhiGiaoHangController::class, 'ThemPhiGiaoHang'])->name('/ThemPhiGiaoHang');
Route::get('/TrangSuaPhiGiaoHang/{MaPhiGiaoHang}', [PhiGiaoHangController::class, 'TrangSuaPhiGiaoHang'])->name('/TrangSuaPhiGiaoHang');
Route::get('/XoaPhiGiaoHang/{MaPhiGiaoHang}', [PhiGiaoHangController::class, 'XoaPhiGiaoHang'])->name('/XoaPhiGiaoHang');
Route::post('/SuaPhiGiaoHang/{MaPhiGiaoHang}', [PhiGiaoHangController::class, 'SuaPhiGiaoHang'])->name('/SuaPhiGiaoHang');
Route::post('/ChonDiaDiem', [PhiGiaoHangController::class, 'ChonDiaDiem'])->name('/ChonDiaDiem');

// Mã giảm giá
Route::get('/TrangThemMaGiamGia', [MaGiamGiaController::class, 'TrangThemMaGiamGia'])->name('/TrangThemMaGiamGia');
Route::get('/TrangLietKeMaGiamGia', [MaGiamGiaController::class, 'TrangLietKeMaGiamGia'])->name('/TrangLietKeMaGiamGia');
Route::post('/ThemMaGiamGia', [MaGiamGiaController::class, 'ThemMaGiamGia'])->name('/ThemMaGiamGia');
Route::get('/TrangSuaMaGiamGia/{MaGiamGia}', [MaGiamGiaController::class, 'TrangSuaMaGiamGia'])->name('/TrangSuaMaGiamGia');
Route::get('/XoaMaGiamGia/{MaGiamGia}', [MaGiamGiaController::class, 'XoaMaGiamGia'])->name('/XoaMaGiamGia');
Route::post('/SuaMaGiamGia/{MaGiamGia}', [MaGiamGiaController::class, 'SuaMaGiamGia'])->name('/SuaMaGiamGia');

// Trang bán hàng
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/SanPhamThuocDanhMuc/{MaDanhMuc}', [HomeController::class, 'SanPhamThuocDanhMuc'])->name('/SanPhamThuocDanhMuc');
Route::get('/HienThiThuongHieu/{MaThuongHieu}', [HomeController::class, 'HienThiThuongHieu'])->name('/HienThiThuongHieu');
Route::get('/HienThiDanhMucCha/{MaDanhMuc}', [HomeController::class, 'HienThiDanhMucCha'])->name('/HienThiDanhMucCha');
Route::get('/HienThiDanhMucCon/{MaDanhMuc}', [HomeController::class, 'HienThiDanhMucCon'])->name('/HienThiDanhMucCon');
Route::get('/ChiTietSanPham/{MaSanPham}', [HomeController::class, 'ChiTietSanPham'])->name('/ChiTietSanPham');
Route::get('/TimKiem', [HomeController::class, 'TimKiem'])->name('/TimKiem');
Route::get('/ThanhToan', [HomeController::class, 'ThanhToan'])->name('/ThanhToan');
Route::get('/UserProfile', [HomeController::class, 'UserProfile'])->name('/UserProfile');
Route::get('/TrangKhachHangDangNhap', [HomeController::class, 'TrangKhachHangDangNhap'])->name('/TrangKhachHangDangNhap');
Route::post('/KhachHangDangNhap', [HomeController::class, 'KhachHangDangNhap'])->name('/KhachHangDangNhap');
Route::get('/KhachHangDangXuat', [HomeController::class, 'KhachHangDangXuat'])->name('/KhachHangDangXuat');

// GioHangController 
Route::post('/ThemGioHang', [GioHangController::class, 'ThemGioHang'])->name('/ThemGioHang');
Route::get('/HienThiGioHang', [GioHangController::class, 'HienThiGioHang'])->name('/HienThiGioHang');
Route::get('/XoaSanPhamTrongGioHang/{session_id}', [GioHangController::class, 'XoaSanPhamTrongGioHang'])->name('/XoaSanPhamTrongGioHang');
Route::post('/ThayDoiSoLuong', [GioHangController::class, 'ThayDoiSoLuong'])->name('/ThayDoiSoLuong');
Route::get('/XoaGioHang', [GioHangController::class, 'XoaGioHang'])->name('/XoaGioHang');
Route::post('/TinhPhiGiaoHang', [GioHangController::class, 'TinhPhiGiaoHang'])->name('/TinhPhiGiaoHang');
Route::get('/XoaPhiGiaoHang', [GioHangController::class, 'XoaPhiGiaoHang'])->name('/XoaPhiGiaoHang');


