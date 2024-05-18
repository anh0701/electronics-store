echo '<pre>';
print_r();
echo '</pre>';

Route::get('/TrangThemMaGiamGia', [MaGiamGiaController::class, 'TrangThemMaGiamGia'])->name('/TrangThemMaGiamGia');
Route::get('/TrangLietKeMaGiamGia', [MaGiamGiaController::class, 'TrangLietKeMaGiamGia'])->name('/TrangLietKeMaGiamGia');
Route::post('/ThemMaGiamGia', [MaGiamGiaController::class, 'ThemMaGiamGia'])->name('/ThemMaGiamGia');
Route::get('/TrangSuaMaGiamGia/{MaGiamGia}', [MaGiamGiaController::class, 'TrangSuaMaGiamGia'])->name('/TrangSuaMaGiamGia');
Route::get('/XoaMaGiamGia/{MaGiamGia}', [MaGiamGiaController::class, 'XoaMaGiamGia'])->name('/XoaMaGiamGia');
Route::post('/SuaMaGiamGia/{MaGiamGia}', [MaGiamGiaController::class, 'SuaMaGiamGia'])->name('/SuaMaGiamGia');


