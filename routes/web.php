<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\ThuongHieuController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Trang admin
// Thuong Hieu San Pham
Route::get('/TrangThemThuongHieu', [ThuongHieuController::class, 'TrangThemThuongHieu'])->name('/TrangThemThuongHieu');
Route::get('/TrangLietKeThuongHieu', [ThuongHieuController::class, 'TrangLietKeThuongHieu'])->name('/TrangLietKeThuongHieu');
Route::post('/ThemThuongHieu', [ThuongHieuController::class, 'ThemThuongHieu'])->name('/ThemThuongHieu');
Route::get('/KichHoatThuongHieu/{MaThuongHieu}', [ThuongHieuController::class, 'KichHoatThuongHieu'])->name('/KichHoatThuongHieu');
Route::get('/KoKichHoatThuongHieu/{MaThuongHieu}', [ThuongHieuController::class, 'KoKichHoatThuongHieu'])->name('/KoKichHoatThuongHieu');
Route::get('/TrangSuaThuongHieu/{MaThuongHieu}', [ThuongHieuController::class, 'TrangSuaThuongHieu'])->name('/TrangSuaThuongHieu');
Route::get('/XoaThuongHieu/{MaThuongHieu}', [ThuongHieuController::class, 'XoaThuongHieu'])->name('/XoaThuongHieu');
Route::post('/SuaThuongHieu/{MaThuongHieu}', [ThuongHieuController::class, 'SuaThuongHieu'])->name('/SuaThuongHieu');

// TaiKhoan
Route::get('/dashboard', [TaiKhoanController::class, 'show_dashboard'])->name('/dashboard');    
Route::get('/TrangLietKeTaiKhoan', [TaiKhoanController::class, 'TrangLietKeTaiKhoan'])->name('/TrangLietKeTaiKhoan');
Route::get('/XemChiTiet/{MaTaiKhoan}', [TaiKhoanController::class, 'XemChiTiet'])->name('/XemChiTiet');
Route::get('/XoaPQND/{MaPQND}', [TaiKhoanController::class, 'XoaPQND'])->name('/XoaPQND');
Route::get('/ThemPQND/{MaTaiKhoan}/{MaPhanQuyen}', [TaiKhoanController::class, 'ThemPQND'])->name('/ThemPQND');
Route::get('/TrangTaoTaiKhoan', [TaiKhoanController::class, 'TrangTaoTaiKhoan'])->name('/TrangTaoTaiKhoan');
Route::get('/TaoTaiKhoan', [TaiKhoanController::class, 'TaoTaiKhoan'])->name('/TaoTaiKhoan');
Route::get('/TrangDangNhap', [TaiKhoanController::class, 'TrangDangNhap'])->name('/TrangDangNhap');
Route::post('/DangNhapAdmin', [TaiKhoanController::class, 'DangNhapAdmin'])->name('/DangNhapAdmin');
Route::get('/DangXuat', [TaiKhoanController::class, 'DangXuat'])->name('/DangXuat');

// Danh muc
Route::get('/TrangThemDanhMuc', [DanhMucController::class, 'TrangThemDanhMuc'])->name('/TrangThemDanhMuc');
Route::get('/TrangLietKeDanhMuc', [DanhMucController::class, 'TrangLietKeDanhMuc'])->name('/TrangLietKeDanhMuc');
Route::post('/ThemDanhMuc', [DanhMucController::class, 'ThemDanhMuc'])->name('/ThemDanhMuc');
Route::get('/KichHoatDanhMuc/{MaDanhMuc}', [DanhMucController::class, 'KichHoatDanhMuc'])->name('/KichHoatDanhMuc');
Route::get('/KoKichHoatDanhMuc/{MaDanhMuc}', [DanhMucController::class, 'KoKichHoatDanhMuc'])->name('/KoKichHoatDanhMuc');
Route::get('/TrangSuaDanhMuc/{MaDanhMuc}', [DanhMucController::class, 'TrangSuaDanhMuc'])->name('/TrangSuaDanhMuc');
Route::get('/XoaDanhMuc/{MaDanhMuc}', [DanhMucController::class, 'XoaDanhMuc'])->name('/XoaDanhMuc');
Route::post('/SuaDanhMuc/{MaDanhMuc}', [DanhMucController::class, 'SuaDanhMuc'])->name('/SuaDanhMuc');

// San pham
Route::get('/TrangThemSanPham', [SanPhamController::class, 'TrangThemSanPham'])->name('/TrangThemSanPham');
Route::get('/TrangLietKeSanPham', [SanPhamController::class, 'TrangLietKeSanPham'])->name('/TrangLietKeSanPham');
Route::post('/ThemSanPham', [SanPhamController::class, 'ThemSanPham'])->name('/ThemSanPham');
Route::get('/KichHoatSanPham/{MaSanPham}', [SanPhamController::class, 'KichHoatSanPham'])->name('/KichHoatSanPham');
Route::get('/KoKichHoatSanPham/{MaSanPham}', [SanPhamController::class, 'KoKichHoatSanPham'])->name('/KoKichHoatSanPham');
Route::get('/TrangSuaSanPham/{MaSanPham}', [SanPhamController::class, 'TrangSuaSanPham'])->name('/TrangSuaSanPham');
Route::get('/XoaSanPham/{MaSanPham}', [SanPhamController::class, 'XoaSanPham'])->name('/XoaSanPham');
Route::post('/SuaSanPham/{MaSanPham}', [SanPhamController::class, 'SuaSanPham'])->name('/SuaSanPham');

// Trang bán hàng
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/SanPhamThuocDanhMuc/{MaDanhMuc}', [HomeController::class, 'SanPhamThuocDanhMuc'])->name('/SanPhamThuocDanhMuc');
Route::get('/HienThiThuongHieu/{MaThuongHieu}', [HomeController::class, 'HienThiThuongHieu'])->name('/HienThiThuongHieu');
Route::get('/HienThiDanhMucCha/{MaDanhMuc}', [HomeController::class, 'HienThiDanhMucCha'])->name('/HienThiDanhMucCha');
Route::get('/HienThiDanhMucCon/{MaDanhMuc}', [HomeController::class, 'HienThiDanhMucCon'])->name('/HienThiDanhMucCon');
Route::get('/ChiTietSanPham/{MaSanPham}', [HomeController::class, 'ChiTietSanPham'])->name('/ChiTietSanPham');
Route::get('/TimKiem', [HomeController::class, 'TimKiem'])->name('/TimKiem');
Route::get('/GioHang', [HomeController::class, 'GioHang'])->name('/GioHang');
Route::get('/TrangKhachHangDangNhap', [HomeController::class, 'TrangKhachHangDangNhap'])->name('/TrangKhachHangDangNhap');
Route::post('/KhachHangDangNhap', [HomeController::class, 'KhachHangDangNhap'])->name('/KhachHangDangNhap');
Route::get('/KhachHangDangXuat', [HomeController::class, 'KhachHangDangXuat'])->name('/KhachHangDangXuat');
//
