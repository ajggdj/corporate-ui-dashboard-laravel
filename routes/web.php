<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\configuracionCotroller;
use App\Http\Controllers\usuariosController;
use App\Http\Controllers\EmployeesCotroller;
use App\Http\Controllers\reportController;
use App\Http\Controllers\StockController;
use App\Livewire\ShopComponent;
use App\Livewire\CartComponent;


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

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/tables', function () {
    return view('tables');
})->name('tables')->middleware('auth');

Route::get('/wallet', function () {
    return view('wallet');
})->name('wallet')->middleware('auth');

Route::get('/RTL', function () {
    return view('RTL');
})->name('RTL')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');

//configuracion del sistema
Route::get('/configuracion',[configuracionCotroller::class, 'index'])->name('configuracion.index')->middleware('auth');
// Mercacia
Route::post('/configuracion/nuevo',[configuracionCotroller::class, 'addtipomercancia'])->name('configuracion.addtipomercancia')->middleware('auth');
Route::post('/configuracion/edittm/{id}',[configuracionCotroller::class, 'edittipomercancia'])->name('configuracion.edittipomercancia')->middleware('auth');
Route::post('/configuracion/eliminar/{id}',[configuracionCotroller::class, 'eliminarmercancia'])->name('configuracion.eliminar')->middleware('auth');

// cantidad
Route::post('/configuracion/nuevo/cantidad',[configuracionCotroller::class, 'addtipocantidad'])->name('configuracion.addtipocantidad')->middleware('auth');
Route::post('/configuracion/editcantidad/{id}',[configuracionCotroller::class, 'edittipocantidad'])->name('configuracion.edittipocantidad')->middleware('auth');
Route::post('/configuracion/eliminar-cantidad/{id}',[configuracionCotroller::class, 'eliminarcantidad'])->name('configuracion.eliminarcantidad')->middleware('auth');

//logo sitio
Route::post('/subir-imagen',[configuracionCotroller::class, 'logoimagen'])->name('configuracion.logoimagen')->middleware('auth');

//usuarios
Route::get('/usuarios', [usuariosController::class, 'index'])->name('usuarios.index')->middleware('auth');
Route::post('/usuarios/nuevo',[usuariosController::class, 'addusuarios'])->name('usuarios.addusuarios')->middleware('auth');
Route::post('/usuarios/editusuarios/{id}',[usuariosController::class, 'editusuarios'])->name('usuarios.editusuarios')->middleware('auth');
Route::post('/usuarios/eliminar-usuarios/{id}',[usuariosController::class, 'eliminarusuarios'])->name('usuarios.eliminarusuarios')->middleware('auth');
Route::post('/usuarios/activar-usuarios/{id}',[usuariosController::class, 'activarusuarios'])->name('usuarios.activarusuarios')->middleware('auth');

//empelados
Route::get('/empleados',[EmployeesCotroller::class, 'index'])->name('empleados.index')->middleware('auth');
Route::post('/empleados/nuevo',[EmployeesCotroller::class, 'addempleado'])->name('empleados.add')->middleware('auth');
Route::post('/empleados/editar/{id}',[EmployeesCotroller::class, 'editar'])->name('empleados.editar')->middleware('auth');
Route::post('/empleados/eliminar/{id}',[EmployeesCotroller::class, 'eliminar'])->name('empleados.eliminar')->middleware('auth');
Route::post('/import', [EmployeesCotroller::class,"import"])->name('empleados.import')->middleware('auth');
Route::get('/export-empleados',[EmployeesCotroller::class,'exportEmpleados'])->name('exportEmpleados')->middleware('auth');

//reportes
Route::get('/reportes', [reportController::class, 'index'])->name('report.index')->middleware('auth');
Route::get('/reportesmaquinaria', [reportController::class, 'indexmaquinaria'])->name('report.indexmaquinaria')->middleware('auth');
Route::get('/detalles/{id}', [reportController::class, 'detalles'])->name('report.detalles')->middleware('auth');
Route::get('/detallesmaquinaria/{id}', [reportController::class, 'detallesmaquina'])->name('report.detallesmaquina')->middleware('auth');
Route::post('/guardarFecha/{id}', [reportController::class, 'detallesmaquinafecha'])->name('report.detallesmaquinafecha')->middleware('auth');
Route::get('generate-pdf/{id}', [reportController::class, 'generatePDF'])->name('report.pdf')->middleware('auth');
Route::get('generate-pdf-normal/{id}', [reportController::class, 'generatePDFnormal'])->name('report.generatePDFnormal')->middleware('auth');
Route::post('/eliminardetalle/{id}', [reportController::class, 'eliminardetalle'])->name('report.eliminardetalle')->middleware('auth');
Route::post('/eliminardetallemaquina/{id}', [reportController::class, 'eliminardetallemaquina'])->name('report.eliminardetallemaquina')->middleware('auth');

//Inventario
Route::get('/inventario', [StockController::class, 'index'])->name('stock.index')->middleware('auth');
Route::get('/pendientes', [StockController::class, 'indexpendientes'])->name('stock.indexpendientes')->middleware('auth');
Route::get('/baja', [StockController::class, 'indexbaja'])->name('stock.indexbaja')->middleware('auth');
Route::get('stock_add', [StockController::class, 'add'])->name('stock.add')->middleware('auth');
Route::post('nuevo_producto', [StockController::class, 'addprodcuto'])->name('stock.nuevoproducto')->middleware('auth');
Route::get('stock_edit/{id}', [StockController::class, 'edit'])->name('stock.edit')->middleware('auth');
Route::post('stock_edit/actualizar/{id}', [StockController::class, 'update'])->name('stock.updatedit')->middleware('auth');
Route::post('stock_eliminar/eliminar/{id}', [StockController::class, 'eliminar'])->name('stock.elminar')->middleware('auth');
Route::post('stock_activo/{id}', [StockController::class, 'activo'])->name('stock.activo')->middleware('auth');

 //shop livewire
 Route::get('/shop', ShopComponent::class)->name('shop');
 Route::get('/cart', CartComponent::class)->name('shop.cart');
 //Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');
