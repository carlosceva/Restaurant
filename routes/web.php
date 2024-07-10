<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DetalleMenuController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PrivilegioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;

Route::get('/', function () {
    return view('principal');
});

Route::get('/dashboard', function () {
    return view('estadisticas');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/cliente', ClienteController::class)->names([
    'index' => 'cliente.index',
    'store' => 'cliente.store',
    'update' => 'cliente.update',
    'destroy' => 'cliente.destroy',
]);

Route::resource('/empleado', EmpleadoController::class)->names([
    'index' => 'empleado.index',
    'store' => 'empleado.store',
    'update' => 'empleado.update',
    'destroy' => 'empleado.destroy',
]);

Route::resource('/empresa', EmpresaController::class)->names([
    'index' => 'empresa.index',
    'store' => 'empresa.store',
    'update' => 'empresa.update',
    'destroy' => 'empresa.destroy',
]);

Route::put('/empresa/{empresa}/nombre', [EmpresaController::class, 'nombre'])->name('empresa.nombre');
Route::put('/empresa/{empresa}/direccion', [EmpresaController::class, 'direccion'])->name('empresa.direccion');
Route::put('/empresa/{empresa}/correo', [EmpresaController::class, 'correo'])->name('empresa.correo');
Route::put('/empresa/{empresa}/telefono', [EmpresaController::class, 'telefono'])->name('empresa.telefono');

Route::resource('/menu', MenuController::class)->names([
    'index' => 'menu.index',
    'store' => 'menu.store',
    'update' => 'menu.update',
    'destroy' => 'menu.destroy',
]);
Route::resource('menus.detalles', DetalleMenuController::class);

Route::resource('/pago', PagoController::class)->names([
    'index' => 'pago.index',
    'store' => 'pago.store',
    'update' => 'pago.update',
    'destroy' => 'pago.destroy',
]);

Route::resource('/privilegio', PrivilegioController::class)->names([
    'index' => 'privilegio.index',
    'store' => 'privilegio.store',
    'update' => 'privilegio.update',
    'destroy' => 'privilegio.destroy',
]);

Route::resource('/producto', ProductoController::class)->names([
    'index' => 'producto.index',
    'store' => 'producto.store',
    'update' => 'producto.update',
    'destroy' => 'producto.destroy',
]);

Route::resource('/promocion', PromocionController::class)->names([
    'index' => 'promocion.index',
    'store' => 'promocion.store',
    'update' => 'promocion.update',
    'destroy' => 'promocion.destroy',
]);

Route::resource('/rol', RoleController::class)->names([
    'index' => 'rol.index',
    'store' => 'rol.store',
    'update' => 'rol.update',
    'destroy' => 'rol.destroy',
]);

Route::resource('/servicio', ServicioController::class)->names([
    'index' => 'servicio.index',
    'store' => 'servicio.store',
    'update' => 'servicio.update',
    'destroy' => 'servicio.destroy',
]);

Route::resource('/venta', VentaController::class)->names([
    'index' => 'venta.index',
    'store' => 'venta.store',
    'update' => 'venta.update',
    'destroy' => 'venta.destroy',
]);

Route::resource('/categoria', CategoriaController::class)->names([
    'index' => 'categoria.index',
    'store' => 'categoria.store',
    'update' => 'categoria.update',
    'destroy' => 'categoria.destroy',
]);

Route::resource('/usuario', UsuarioController::class)->names([
    'index' => 'usuario.index',
    'store' => 'usuario.store',
    'update' => 'usuario.update',
    'destroy' => 'usuario.destroy',
]);

//vista para intrusos
Route::get('/unauthorized', [EmpresaController::class, 'intruso'])->name('intruso');

Route::post('detalle_ventas/calcular', [DetalleVentaController::class, 'calcularTotal'])->name('detalle_ventas.calcular'); 
Route::get('ventas/{venta}/detalles', [VentaController::class, 'detalles'])->name('ventas.detalles');
Route::get('/menus/{menu}/detalles', [MenuController::class, 'detalles'])->name('menus.detalles');

require __DIR__.'/auth.php';
