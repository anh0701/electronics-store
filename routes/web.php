<?php

use App\Http\Controllers\ChuongTrinhGiamGiaController;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\PhieuGiamGiaController;
use App\Http\Controllers\PhieuXuatController;
use App\Http\Controllers\TonKhoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhieuNhapController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\ThuongHieuController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DanhMucTSKTController;
use App\Http\Controllers\DatLaiMatKhau;
use App\Http\Controllers\DoiMatKhau;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\PhiGiaoHangController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\QuenMatKhau;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\ThongSoKyThuatController;


// Trang admin
//TonKho
Route::get('liet-ke-ton-kho', [TonKhoController::class, 'lietKe'])->name('lietKeTonKho');
Route::get('tim-kiem-san-pham-ton-kho', [TonKhoController::class, 'timKiemSPTK'])->name('timKiemSPTK');

//PhieuXuat
Route::get('/xem-phieu-xuat', [PhieuXuatController::class, 'xem'])->name('xemPX');
Route::get('/xem-chi-tiet-phieu-xuat/{id}', [PhieuXuatController::class, 'xemCT'])->name('xemCT');

Route::get('/lap-phieu-xuat', [PhieuXuatController::class, 'taoPX'])->name('taoPX');
Route::post('/lap-phieu-xuat', [PhieuXuatController::class, 'xuLyLapPX'])->name('xuLyLapPX');
Route::post('/lap-phieu-xuat-chi-tiet1', [PhieuXuatController::class, 'xuLyLapPXCT1'])->name('xuLyLapPXCT1');
Route::post('/lap-phieu-xuat-chi-tiet', [PhieuXuatController::class, 'taoPXCT'])->name('xuLyLapPXCT');
Route::get('/luuPX/{id}', [PhieuXuatController::class, 'luuPX'])->name('luuPX');

Route::get('/xoa-phieu-xuat/{id}', [PhieuXuatController::class, 'xoaPX'])->name('xoaPX');
Route::get('/xoa-chi-tiet-phieu-xuat/{id}/{maPX}', [PhieuXuatController::class, 'xoaCTPXS'])->name('xoaCTPXS');
Route::get('/xoa-chi-tiet-phieu-xuat1/{id}/{maPX}', [PhieuXuatController::class, 'xoaCT'])->name('xoaCTL');

Route::get('/sua-phieu-xuat/{id}', [PhieuXuatController::class, 'suaPX'])->name('suaPX');
Route::post('/sua-phieu-xuat', [PhieuXuatController::class, 'suaPXP'])->name('suaPXP');
Route::post('/update-soluong-px', [PhieuXuatController::class, 'updateSoLuong'])->name('update.soluong-px');

Route::get('/api/san-pham-px', [PhieuNhapController::class, 'danhSachSanPham'])->name('api.san-pham-px');

//PhieuNhap
Route::get('/liet-ke-phieu-nhap', [PhieuNhapController::class, 'trangXemPhieuNhap'])->name('xemPN');
Route::get('/xem-phieu-nhap/{id}', [PhieuNhapController::class, 'xemCTPN'])->name('xemCTPN');

Route::get('/lap-phieu-nhap', [PhieuNhapController::class, 'lapPN'])->name('lapPN');
Route::post('/lap-phieu-nhap', [PhieuNhapController::class, 'xuLyPN'])->name('xuLyLapPN');

Route::post('/lap-phieu-nhap-chi-tiet', [PhieuNhapController::class, 'xuLyLapPNCT'])->name('xuLyLapPNCT');
Route::post('/lap-phieu-nhap-chi-tiet1', [PhieuNhapController::class, 'xuLyLapPNCT1'])->name('xuLyLapPNCT1');
Route::get('/api/san-pham-pn', [PhieuNhapController::class, 'danhSachSanPham'])->name('api.san-pham-pn');

Route::get('/xoa-phieu-nhap/{id}', [PhieuNhapController::class, 'xoaPN'])->name('xoaPN');
Route::get('/xoaCTPN/{id}', [PhieuNhapController::class, 'xoaCTPN'])->name('xoaCTPN');
Route::get('/xoaCTs/{id}', [PhieuNhapController::class, 'xoaCTS'])->name('xoaCTS');

Route::get('/luu-phieu-nhap/{id}', [PhieuNhapController::class, 'luuPN'])->name('luuPN');

Route::get('/sua-phieu-nhap/{id}', [PhieuNhapController::class, 'suaPN'])->name('suaPN');
Route::post('/xuLySuaPN', [PhieuNhapController::class, 'xuLySuaPN'])->name('xuLySuaPN');

Route::post('/update-soluong', [PhieuNhapController::class, 'updateSoLuong'])->name('update.soluong');



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
//Route::get('/cap-nhat-tai-khoan', [TaiKhoanController::class, 'capNhatTK'])->name('capNhatTK');
//Route::post('/xuLyCapNhatTK', [TaiKhoanController::class, 'xuLyCNTK'])->name('xuLyCapNhatTK');

Route::get('/dashboard', [TaiKhoanController::class, 'show_dashboard'])->name('/dashboard');
Route::get('/trangAdmin', [TaiKhoanController::class, 'trangAdmin'])->name('/trangAdmin');



// Bài viết
Route::get('/TrangThemBaiViet', [BaiVietController::class, 'TrangThemBaiViet'])->name('/TrangThemBaiViet');
Route::get('/TrangLietKeBaiViet', [BaiVietController::class, 'TrangLietKeBaiViet'])->name('/TrangLietKeBaiViet');
Route::post('/ThemBaiViet', [BaiVietController::class, 'ThemBaiViet'])->name('/ThemBaiViet');
Route::get('/TrangSuaBaiViet/{MaBaiViet}', [BaiVietController::class, 'TrangSuaBaiViet'])->name('/TrangSuaBaiViet');
Route::get('/XoaBaiViet/{MaBaiViet}', [BaiVietController::class, 'XoaBaiViet'])->name('/XoaBaiViet');
Route::post('/SuaBaiViet/{MaBaiViet}', [BaiVietController::class, 'SuaBaiViet'])->name('/SuaBaiViet');
Route::get('/KoKichHoatBaiViet/{MaBaiViet}', [BaiVietController::class, 'KoKichHoatBaiViet'])->name('/KoKichHoatBaiViet');
Route::get('/KichHoatBaiViet/{MaBaiViet}', [BaiVietController::class, 'KichHoatBaiViet'])->name('/KichHoatBaiViet');

// Danh mục bài viết
Route::get('/TrangThemDanhMucBV', [BaiVietController::class, 'TrangThemDanhMucBV'])->name('/TrangThemDanhMucBV');
Route::get('/TrangLietKeDanhMucBV', [BaiVietController::class, 'TrangLietKeDanhMucBV'])->name('/TrangLietKeDanhMucBV');
Route::post('/ThemDanhMucBV', [BaiVietController::class, 'ThemDanhMucBV'])->name('/ThemDanhMucBV');
Route::get('/TrangSuaDanhMucBV/{MaDanhMucBV}', [BaiVietController::class, 'TrangSuaDanhMucBV'])->name('/TrangSuaDanhMucBV');
Route::get('/XoaDanhMucBV/{MaDanhMucBV}', [BaiVietController::class, 'XoaDanhMucBV'])->name('/XoaDanhMucBV');
Route::post('/SuaDanhMucBV/{MaDanhMucBV}', [BaiVietController::class, 'SuaDanhMucBV'])->name('/SuaDanhMucBV');
Route::get('/KoKichHoatDanhMucBV/{MaDanhMucBV}', [BaiVietController::class, 'KoKichHoatDanhMucBV'])->name('/KoKichHoatDanhMucBV');
Route::get('/KichHoatDanhMucBV/{MaDanhMucBV}', [BaiVietController::class, 'KichHoatDanhMucBV'])->name('/KichHoatDanhMucBV');
Route::get('/dashboard', [TaiKhoanController::class, 'show_dashboard'])->name('/dashboard')->middleware('DangNhap');
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
Route::post('/SuaTSKTChoSanPham', [SanPhamController::class, 'SuaTSKTChoSanPham'])->name('/SuaTSKTChoSanPham');
Route::get('/TrangSanPhamTSKT/{MaSanPham}', [SanPhamController::class, 'TrangSanPhamTSKT'])->name('/TrangSanPhamTSKT');

// Phí giao hàng
Route::get('/TrangThemPhiGiaoHang', [PhiGiaoHangController::class, 'TrangThemPhiGiaoHang'])->name('/TrangThemPhiGiaoHang');
Route::get('/TrangLietKePhiGiaoHang', [PhiGiaoHangController::class, 'TrangLietKePhiGiaoHang'])->name('/TrangLietKePhiGiaoHang');
Route::post('/ThemPhiGiaoHang', [PhiGiaoHangController::class, 'ThemPhiGiaoHang'])->name('/ThemPhiGiaoHang');
Route::get('/TrangSuaPhiGiaoHang/{MaPhiGiaoHang}', [PhiGiaoHangController::class, 'TrangSuaPhiGiaoHang'])->name('/TrangSuaPhiGiaoHang');
Route::get('/XoaPhiGiaoHang/{MaPhiGiaoHang}', [PhiGiaoHangController::class, 'XoaPhiGiaoHang'])->name('/XoaPhiGiaoHang');
Route::post('/SuaPhiGiaoHang/{MaPhiGiaoHang}', [PhiGiaoHangController::class, 'SuaPhiGiaoHang'])->name('/SuaPhiGiaoHang');
Route::post('/ChonDiaDiem', [PhiGiaoHangController::class, 'ChonDiaDiem'])->name('/ChonDiaDiem');

// Đơn hàng
Route::get('/TrangLietKeDonHang', [DonHangController::class, 'TrangLietKeDonHang'])->name('/TrangLietKeDonHang');
Route::get('/TrangChiTietDonHang/{order_code}', [DonHangController::class, 'TrangChiTietDonHang'])->name('/TrangChiTietDonHang');
Route::get('/XoaChiTietDonHang/{MaCTDH}/{order_code}', [DonHangController::class, 'XoaChiTietDonHang'])->name('/XoaChiTietDonHang');
Route::get('/XoaPhieuGiamGiaThuocDonHang/{MaDonHang}/{MaGiamGia}', [DonHangController::class, 'XoaPhieuGiamGiaThuocDonHang'])->name('/XoaPhieuGiamGiaThuocDonHang');
Route::get('/XoaDonHang/{MaDonHang}/{order_code}', [DonHangController::class, 'XoaDonHang'])->name('/XoaDonHang');
Route::get('/TrangSuaThongTinGiaoHang/{MaGiaoHang}/{order_code}', [DonHangController::class, 'TrangSuaThongTinGiaoHang'])->name('/TrangSuaThongTinGiaoHang');
Route::post('/SuaThongTinGiaoHang/{MaGiaoHang}/{order_code}', [DonHangController::class, 'SuaThongTinGiaoHang'])->name('/SuaThongTinGiaoHang');
Route::post('/SuaSoLuongSanPham/{MaCTDH}/{order_code}', [DonHangController::class, 'SuaSoLuongSanPham'])->name('/SuaSoLuongSanPham');
Route::post('/SuaTrangThaiDonHang/{MaDonHang}/{order_code}', [DonHangController::class, 'SuaTrangThaiDonHang'])->name('/SuaTrangThaiDonHang');

// Đánh giá
Route::post('/DanhGia', [DanhGiaController::class, 'DanhGia'])->name('/DanhGia');
Route::get('/TrangLietKeDanhGia', [DanhGiaController::class, 'TrangLietKeDanhGia'])->name('/TrangLietKeDanhGia');
Route::get('/KichHoatDanhGia/{MaDanhGia}', [DanhGiaController::class, 'KichHoatDanhGia'])->name('/KichHoatDanhGia');
Route::get('/KoKichHoatDanhGia/{MaDanhGia}', [DanhGiaController::class, 'KoKichHoatDanhGia'])->name('/KoKichHoatDanhGia');
Route::get('/XoaDanhGia/{MaDanhGia}', [DanhGiaController::class, 'XoaDanhGia'])->name('/XoaDanhGia');
Route::post('/BinhLuan', [DanhGiaController::class, 'BinhLuan'])->name('/BinhLuan');
Route::get('/TrangLietKeBinhLuan', [DanhGiaController::class, 'TrangLietKeBinhLuan'])->name('/TrangLietKeBinhLuan');
Route::get('/KichHoatBinhLuan/{MaBinhLuan}', [DanhGiaController::class, 'KichHoatBinhLuan'])->name('/KichHoatBinhLuan');
Route::get('/KoKichHoatBinhLuan/{MaBinhLuan}', [DanhGiaController::class, 'KoKichHoatBinhLuan'])->name('/KoKichHoatBinhLuan');
Route::get('/XoaBinhLuan/{MaBinhLuan}', [DanhGiaController::class, 'XoaBinhLuan'])->name('/XoaBinhLuan');


// Trang bán hàng
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/SanPhamThuocDanhMuc/{MaDanhMuc}', [HomeController::class, 'SanPhamThuocDanhMuc'])->name('/SanPhamThuocDanhMuc');
Route::get('/HienThiSanPhamTheoTH/{MaThuongHieu}/{MaDanhMuc}', [HomeController::class, 'HienThiSanPhamTheoTH'])->name('/HienThiSanPhamTheoTH');
Route::get('/HienThiDanhMucCha/{MaDanhMuc}', [HomeController::class, 'HienThiDanhMucCha'])->name('/HienThiDanhMucCha');
Route::get('/HienThiDanhMucCon/{MaDanhMuc}', [HomeController::class, 'HienThiDanhMucCon'])->name('/HienThiDanhMucCon');
Route::get('/ChiTietSanPham/{MaSanPham}', [HomeController::class, 'ChiTietSanPham'])->name('/ChiTietSanPham');
Route::get('/TimKiem', [HomeController::class, 'TimKiem'])->name('/TimKiem');
Route::get('/ThanhToan', [HomeController::class, 'ThanhToan'])->name('/ThanhToan');
Route::get('/thong-tin-tai-khoan', [HomeController::class, 'thongTinTaiKhoan'])->name('/thong-tin-tai-khoan');
Route::post('/thong-tin-tai-khoan', [TaiKhoanController::class, 'xuLyCNTK'])->name('/thongTinTaiKhoan');
Route::get('/TrangKhachHangDangNhap', [HomeController::class, 'TrangKhachHangDangNhap'])->name('/TrangKhachHangDangNhap');
Route::post('/KhachHangDangNhap', [HomeController::class, 'KhachHangDangNhap'])->name('/KhachHangDangNhap');
Route::get('/KhachHangDangXuat', [HomeController::class, 'KhachHangDangXuat'])->name('/KhachHangDangXuat');
Route::get('/HienThiSanPhamTheoTSKT/{MaTSKT}/{MaDanhMuc}', [HomeController::class, 'HienThiSanPhamTheoTSKT'])->name('/HienThiSanPhamTheoTSKT');
Route::get('/HienThiBaiViet', [HomeController::class, 'HienThiBaiViet'])->name('/HienThiBaiViet');
Route::get('/HienThiBaiVietTheoDMBV/{MaDanhMucBV}', [HomeController::class, 'HienThiBaiVietTheoDMBV'])->name('/HienThiBaiVietTheoDMBV');
Route::get('/ChiTietBaiViet/{MaBaiViet}', [HomeController::class, 'ChiTietBaiViet'])->name('/ChiTietBaiViet');

// GioHangController
Route::post('/ThemGioHang', [GioHangController::class, 'ThemGioHang'])->name('/ThemGioHang');
Route::get('/HienThiGioHang', [GioHangController::class, 'HienThiGioHang'])->name('/HienThiGioHang');
Route::get('/XoaSanPhamTrongGioHang/{session_id}', [GioHangController::class, 'XoaSanPhamTrongGioHang'])->name('/XoaSanPhamTrongGioHang');
Route::post('/ThayDoiSoLuong', [GioHangController::class, 'ThayDoiSoLuong'])->name('/ThayDoiSoLuong');
Route::get('/XoaGioHang', [GioHangController::class, 'XoaGioHang'])->name('/XoaGioHang');
Route::post('/TinhPhiGiaoHang', [GioHangController::class, 'TinhPhiGiaoHang'])->name('/TinhPhiGiaoHang');
Route::get('/HuyPhiGiaoHang', [GioHangController::class, 'HuyPhiGiaoHang'])->name('/HuyPhiGiaoHang');
Route::post('/ApDungPhieuGiamGia', [GioHangController::class, 'ApDungPhieuGiamGia'])->name('/ApDungPhieuGiamGia');
Route::get('/HuyPhieuGiamGia', [GioHangController::class, 'HuyPhieuGiamGia'])->name('/HuyPhieuGiamGia');
Route::post('/DatHang', [GioHangController::class, 'DatHang'])->name('/DatHang');

// phieu giam gia
Route::get('/liet-ke-phieu-giam-gia', [PhieuGiamGiaController::class, 'phieuGiamGia'])->name('/liet-ke-phieu-giam-gia');
Route::get('/them-phieu-giam-gia', [PhieuGiamGiaController::class, 'giaoDienTao'])->name('/them-phieu-giam-gia');
Route::post('/them-phieu-giam-gia', [PhieuGiamGiaController::class, 'taoPhieuGiamGia'])->name('/them-phieu-giam-gia');
Route::get('/sua-phieu-giam-gia/{MaGiamGia}', [PhieuGiamGiaController::class, 'giaoDienSua'])->name('/sua-phieu-giam-gia');
Route::post('/sua-phieu-giam-gia/{MaGiamGia}', [PhieuGiamGiaController::class, 'suaPhieuGiamGia'])->name('/suaPhieuGG');
Route::get('/xoa-phieu-giam-gia/{MaGiamGia}', [PhieuGiamGiaController::class, 'Xoa'])->name('/xoa-phieu-giam-gia');
Route::get('/tim-kiem-phieu-giam-gia', [PhieuGiamGiaController::class, 'timKiem'])->name('/timKiem');

// ThemPhieuGiamGiaND
Route::get('/ThemPhieuGiamGiaND', [PhieuGiamGiaController::class, 'ThemPhieuGiamGiaND'])->name('/ThemPhieuGiamGiaND');
Route::get('/LietKePhieuGiamGiaND', [PhieuGiamGiaController::class, 'LietKePhieuGiamGiaND'])->name('/LietKePhieuGiamGiaND');
Route::get('/XemPhieuGiamGiaND/{Email}', [PhieuGiamGiaController::class, 'XemPhieuGiamGiaND'])->name('/XemPhieuGiamGiaND');

// chuong trinh giam gia
Route::get('/tao-chuong-trinh-giam-gia', [ChuongTrinhGiamGiaController::class, 'giaoDienTao'])->name('/tao-chuong-trinh-giam-gia');
Route::post('/tao-chuong-trinh-giam-gia', [ChuongTrinhGiamGiaController::class, 'taoChuongTrinhGiamGia'])->name('/taoChuongTrinhGiamGia');
Route::get('/api/san-pham', [ChuongTrinhGiamGiaController::class, 'danhSachSanPham'])->name('api.san-pham');
Route::get('/chuong-trinh-giam-gia', [ChuongTrinhGiamGiaController::class, 'giaoDienLietKe'])->name('/chuong-trinh-giam-gia');
Route::get('/xoa-chuong-trinh-giam-gia/{MaCT}', [ChuongTrinhGiamGiaController::class, 'xoa'])->name('/xoa-chuong-trinh-giam-gia');
Route::get('/sua-chuong-trinh-giam-gia/{MaCT}', [ChuongTrinhGiamGiaController::class, 'giaoDienSua'])->name('/sua-chuong-trinh-giam-gia');
Route::middleware('TrangThaiCTGG')->group(function () {
    Route::post('/sua-chuong-trinh-giam-gia/{MaCT}', [ChuongTrinhGiamGiaController::class, 'suaChuongTrinhGiamGia'])->name('/suaChuongTrinhGiamGia');
});
Route::get('/chuong-trinh-giam-gia/{MaCT}', [ChuongTrinhGiamGiaController::class, 'xemCT'])->name('/xem-chi-tiet-ctgg');
Route::get('/sanpham/list', [ChuongTrinhGiamGiaController::class, 'list'])->name('sanpham.list');
Route::get('/tim-kiem-chuong-trinh-giam-gia', [ChuongTrinhGiamGiaController::class, 'timKiem'])->name('/timKiem');

Route::get('/Test', [ChuongTrinhGiamGiaController::class, 'Test'])->name('/Test');

Route::get('/TrangThemCTGG', [ChuongTrinhGiamGiaController::class, 'TrangThemCTGG'])->name('/TrangThemCTGG');
Route::get('/TrangThemCTGGSP', [ChuongTrinhGiamGiaController::class, 'TrangThemCTGGSP'])->name('/TrangThemCTGGSP');
Route::post('/ThemCTGGVaoSession', [ChuongTrinhGiamGiaController::class, 'ThemCTGGVaoSession'])->name('/ThemCTGGVaoSession');
Route::post('/HienThiSanPham', [ChuongTrinhGiamGiaController::class, 'HienThiSanPham'])->name('/HienThiSanPham');
Route::get('/ThemSanPhamVaoSession/{MaSanPham}', [ChuongTrinhGiamGiaController::class, 'ThemSanPhamVaoSession'])->name('/ThemSanPhamVaoSession');
Route::get('/XoaSanPhamKhoiSession/{session_id}', [ChuongTrinhGiamGiaController::class, 'XoaSanPhamKhoiSession'])->name('/XoaSanPhamKhoiSession');
Route::post('/SuaPhanTramGiamSanPham/{session_id}', [ChuongTrinhGiamGiaController::class, 'SuaPhanTramGiamSanPham'])->name('/SuaPhanTramGiamSanPham');
Route::post('/ThemCTGG', [ChuongTrinhGiamGiaController::class, 'ThemCTGG'])->name('/ThemCTGG');
