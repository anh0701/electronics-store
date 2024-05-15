<?php

use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\PhieuGiamGiaController;
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
use App\Http\Controllers\DatLaiMatKhau;
use App\Http\Controllers\DoiMatKhau;
use App\Http\Controllers\QuenMatKhau;

// Trang admin
//PhieuNhap
Route::get('/liet-ke-phieu-nhap', [PhieuNhapController::class, 'trangXemPhieuNhap'])->name('xemPN');
Route::get('/lap-phieu-nhap', [PhieuNhapController::class, 'lapPN'])->name('lapPN');
Route::post('/xuLyThemMatHang', [PhieuNhapController::class, 'xuLyThemMatHang']);
Route::get('/xoaMatHang/{id}', [PhieuNhapController::class, 'xoaMatHang'])->name('xoaMatHang');
Route::post('/xuLyLapPN', [PhieuNhapController::class, 'xuLyPN']);
Route::get('/xem-phieu-nhap/{id}', [PhieuNhapController::class, 'xemCTPN'])->name('xemCTPN');
Route::get('/sua-phieu-nhap/{id}', [PhieuNhapController::class, 'suaPN'])->name('suaPN');
Route::post('/xuLySuaPN', [PhieuNhapController::class, 'xuLySuaPN']);
Route::get('/xoa-phieu-nhap/{id}', [PhieuNhapController::class, 'xoaPN'])->name('xoaPN');

//Nha cung cap
Route::get('/liet-ke-nha-cung-cap', [NhaCungCapController::class, 'lietKe'])->name('lietKeNCC');
Route::get('/them-nha-cung-cap', [NhaCungCapController::class, 'themNCC'])->name('themNCC');
Route::post('/xuLyThemNCC', [NhaCungCapController::class, 'xuLyThemNCC']);
Route::get('/sua-nha-cung-cap/{id}', [NhaCungCapController::class, 'suaNCC'])->name('suaNCC');
Route::post('/xuLySuaNCC', [NhaCungCapController::class, 'xuLySuaNCC'])->name('xuLySuaNCC');
Route::get('/xoa-nha-cung-cap/{id}', [NhaCungCapController::class, 'xoaNCC'])->name('xoaNCC');
Route::get('/tim-kiem-nha-cung-cap', [NhaCungCapController::class, 'timkiemNCC'])->name('timkiemNCC');

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
Route::get('/tim-kiem-tai-khoan', [TaiKhoanController::class, 'timkiemTK'])->name('timkiemTK');
Route::get('/cap-nhat-tai-khoan', [TaiKhoanController::class, 'capNhatTK'])->name('capNhatTK');
Route::post('/xuLyCapNhatTK', [TaiKhoanController::class, 'xuLyCNTK'])->name('xuLyCapNhatTK');

Route::get('/dashboard', [TaiKhoanController::class, 'show_dashboard'])->name('/dashboard');
// Route::get('/TrangLietKeTaiKhoan', [TaiKhoanController::class, 'TrangLietKeTaiKhoan'])->name('/TrangLietKeTaiKhoan');
// Route::get('/XemChiTiet/{MaTaiKhoan}', [TaiKhoanController::class, 'XemChiTiet'])->name('/XemChiTiet');
// Route::get('/XoaPQND/{MaPQND}', [TaiKhoanController::class, 'XoaPQND'])->name('/XoaPQND');
// Route::get('/ThemPQND/{MaTaiKhoan}/{MaPhanQuyen}', [TaiKhoanController::class, 'ThemPQND'])->name('/ThemPQND');
// Route::get('/TrangTaoTaiKhoan', [TaiKhoanController::class, 'TrangTaoTaiKhoan'])->name('/TrangTaoTaiKhoan');
// Route::get('/TaoTaiKhoan', [TaiKhoanController::class, 'TaoTaiKhoan'])->name('/TaoTaiKhoan');
// Route::get('/TrangDangNhap', [TaiKhoanController::class, 'TrangDangNhap'])->name('/TrangDangNhap');
// Route::post('/DangNhapAdmin', [TaiKhoanController::class, 'DangNhapAdmin'])->name('/DangNhapAdmin');
// Route::get('/DangXuat', [TaiKhoanController::class, 'DangXuat'])->name('/DangXuat');

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

// Sản phẩm TSKT
Route::get('/TrangThemSanPhamTSKT', [SanPhamTSKTController::class, 'TrangThemSanPhamTSKT'])->name('/TrangThemSanPhamTSKT');
Route::get('/TrangLietKeSanPhamTSKT', [SanPhamTSKTController::class, 'TrangLietKeSanPhamTSKT'])->name('/TrangLietKeSanPhamTSKT');
Route::post('/ThemSanPhamTSKT', [SanPhamTSKTController::class, 'ThemSanPhamTSKT'])->name('/ThemSanPhamTSKT');
Route::get('/TrangSuaSanPhamTSKT/{MaDMTSKT}', [SanPhamTSKTController::class, 'TrangSuaSanPhamTSKT'])->name('/TrangSuaSanPhamTSKT');
Route::post('/SuaSanPhamTSKT/{MaDMTSKT}', [SanPhamTSKTController::class, 'SuaSanPhamTSKT'])->name('/SuaSanPhamTSKT');
Route::get('/XoaSanPhamTSKT/{MaDMTSKT}', [SanPhamTSKTController::class, 'XoaSanPhamTSKT'])->name('/XoaSanPhamTSKT');
Route::post('/ChangeTable', [SanPhamTSKTController::class, 'ChangeTable'])->name('/ChangeTable');


// San pham
Route::get('/TrangThemSanPham', [SanPhamController::class, 'TrangThemSanPham'])->name('/TrangThemSanPham');
Route::get('/TrangLietKeSanPham', [SanPhamController::class, 'TrangLietKeSanPham'])->name('/TrangLietKeSanPham');
Route::post('/ChonDanhMuc', [SanPhamController::class, 'ChonDanhMuc'])->name('/ChonDanhMuc');
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
Route::get('/ThanhToan', [HomeController::class, 'ThanhToan'])->name('/ThanhToan');
Route::get('/TrangKhachHangDangNhap', [HomeController::class, 'TrangKhachHangDangNhap'])->name('/TrangKhachHangDangNhap');
Route::post('/KhachHangDangNhap', [HomeController::class, 'KhachHangDangNhap'])->name('/KhachHangDangNhap');
Route::get('/KhachHangDangXuat', [HomeController::class, 'KhachHangDangXuat'])->name('/KhachHangDangXuat');

// GioHangController
Route::post('/them-gio-hang', [GioHangController::class, 'them_gio_hang'])->name('/them-gio-hang');
Route::get('/hien-thi-gio-hang', [GioHangController::class, 'hien_thi_gio_hang'])->name('/hien-thi-gio-hang');
Route::get('/xoa-sp-trong-gio-hang/{session_id}', [GioHangController::class, 'xoa_sp_trong_gio_hang'])->name('/xoa-sp-trong-gio-hang');
Route::post('/thay-doi-so-luong', [GioHangController::class, 'thay_doi_so_luong'])->name('/thay-doi-so-luong');
Route::get('/xoa-gio-hang', [GioHangController::class, 'xoa_gio_hang'])->name('/xoa-gio-hang');

// phieu giam gia
Route::get('/liet-ke-phieu-giam-gia', [PhieuGiamGiaController::class, 'phieuGiamGia'])->name('/liet-ke-phieu-giam-gia');
Route::get('/them-phieu-giam-gia', [PhieuGiamGiaController::class, 'giaoDienTao'])->name('/them-phieu-giam-gia');
Route::post('/them-phieu-giam-gia', [PhieuGiamGiaController::class, 'taoPhieuGiamGia'])->name('/them-phieu-giam-gia');
Route::get('/sua-phieu-giam-gia/{MaGiamGia}', [PhieuGiamGiaController::class, 'giaoDienSua'])->name('/sua-phieu-giam-gia');
Route::post('/sua-phieu-giam-gia/{MaGiamGia}', [PhieuGiamGiaController::class, 'suaPhieuGiamGia'])->name('/suaPhieuGG');
Route::get('/xoa-phieu-giam-gia/{MaGiamGia}', [PhieuGiamGiaController::class, 'Xoa'])->name('/xoa-phieu-giam-gia');
