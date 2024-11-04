<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CulturaController as AdminCulturaController;
use App\Http\Controllers\Admin\EstadoController as AdminEstadoController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ReseniaController as AdminReseniaController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\VerificarCuentaController;
use App\Http\Controllers\Admin\ZonaController as AdminZonaController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Usuario\ContactanosController;
use App\Http\Controllers\Usuario\CulturaController;
use App\Http\Controllers\Usuario\EstadoController;
use App\Http\Controllers\Usuario\HomeController;
use App\Http\Controllers\Usuario\QuizzController;
use App\Http\Controllers\Usuario\ReseniaController;
use App\Http\Controllers\Usuario\ZonaController;
use Illuminate\Support\Facades\Route;




/*______________________ RUTAS   DEL    USUARIO ____________________*/

// grupo de ruts para el index / home
Route::controller(HomeController::class) -> prefix('/') -> group(function() {
    Route::get('', 'index') -> name('home');
    Route::get('mapa-estados', 'mapa_estados_index') -> name('mapa_estados.index');
    Route::get('mapa-zonas', 'mapa_zonas_index') -> name('mapa_zonas.index');
    Route::get('nosotros', 'nosotros_index') -> name('nosotros.index');
});

// grupo de rutas para la seccion de zonas
Route::controller(ZonaController::class) -> prefix('zonas') -> group(function() {
    Route::get('', 'index') -> name('zonas.index');
    Route::get('{zona}', 'show') -> name('zonas.show');
});

// grupo de rutas para la seccion de estados de la republica
Route::controller(EstadoController::class) -> prefix('estados') -> group(function() {
    Route::get('', 'index') -> name('estados.index');
    Route::get('{estado}', 'show') -> name('estados.show');
});

// grupo de rutas para la seccion de culturas de mexico
Route::controller(CulturaController::class) -> prefix('culturas') -> group(function() {
    Route::get('', 'index') -> name('culturas.index');
    Route::get('{cultura}', 'show') -> name('culturas.show');
});

// grupo de rutas para la seccion del foro / reseñas
Route::controller(ReseniaController::class) -> prefix('foro') -> group(function() {
    Route::get('', 'index') -> name('foro.index');
    Route::get('{resenia}', 'show') -> name('foro.show');
});

// grupo de rutas para el formulario de contacto
Route::controller(ContactanosController::class) -> prefix('contactanos') -> group(function() {
    Route::get('', 'index') -> name('contactanos.index');
    Route::post('', 'store') -> name('contactanos.store');
});

// grupo de rutas para la seccion del quizz
Route::controller(QuizzController::class) -> prefix('quizz') -> group(function() {
    Route::get('', 'index') -> name('quizz.index');
});





/* _____________________ RUTAS   PARA    AUTH __________________*/

// AUTH LOGIN
Route::get('login', [LoginController::class, 'index']) -> name('login');

// AUTH GOOGLE
Route::get('auth/google', [GoogleAuthController::class, 'redirect']) -> name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);





/*______________________ RUTAS   DEL    ADMIM ____________________*/

// grupo de rutas para el dashboard
Route::controller(AdminHomeController::class) -> prefix('admin')->group(function () {
    Route::get('dashboard', 'index') -> name('dashboard');
    Route::get('database',  'database_index') -> name('database.index');
    Route::get('migraciones',  'migraciones_index') -> name('admin.migrations.index');
    Route::get('roles',  'roles_index') -> name('admin.roles.index');
    Route::get('culturas-estados',  'culturas_estados_index') -> name('admin.culturas_estados.index');
    Route::get('zonas-imagenes', 'zonas_imagenes_index') -> name('admin.zonas_fotos.index');
    Route::get('resenias-imagenes', 'resenias_imagenes_index') -> name('admin.resenias_fotos.index');
    Route::get('culturas-imagenes', 'culturas_imagenes_index') -> name('admin.culturas_fotos.index');
    Route::get('ubicaciones-zonas', 'ubicaciones_zonas_index') -> name('admin.ubicaciones_zonas.index');
    Route::get('ubicaciones-estados', 'ubicaciones_estados_index') -> name('admin.ubicaciones_estados.index');
});

Route::controller(VerificarCuentaController::class) -> prefix('verificar-administrador') -> group(function() {
    Route::get('', 'index') -> name('admin.verificar_cuenta.index');
    Route::put('',  'verify') -> name('admin.verificar_cuenta.verify');
    Route::put('update', 'update') -> name('admin.verificar_cuenta.update');
});

// grupo de rutas para el controlador de las culturas
Route::resource('admin/culturas', AdminCulturaController::class)
        -> parameters(['culturas' => 'culture'])
        -> names('admin.culturas');

// grupo de rutas para el controlador de los estados
Route::resource('admin/estados', AdminEstadoController::class)
-> parameters(['estados' => 'state'])
-> names('admin.estados');

// grupo de rutas para el controlador de las zonas
Route::resource('admin/zonas', AdminZonaController::class)
        -> parameters(['zonas' => 'zone'])
        -> names('admin.zonas');

// grupo de rutas para el controlador de los administradores
Route::controller(AdminController::class) -> prefix('admin')-> group(function () {
    Route::get('create', 'create') -> name('admin.create');
    Route::post('', 'store') -> name('admin.store');
    Route::get('{admin}', 'show') -> name('admin.show');
    Route::get('{admin}/edit', 'edit') -> name('admin.edit');
    Route::put('{admin}', 'update') -> name('admin.update');
    Route::delete('{admin}', 'destroy') -> name('admin.delete');
});

// grupo de rutas para los usuarios
Route::controller(UsuarioController::class) -> prefix('admin/usuarios')-> group(function () {
    Route::get('', 'index')-> name('admin.usuarios.index');
    Route::get('{usuario}', 'show') -> name('admin.usuarios.show');
    Route::get('{usuario}/edit', 'edit') -> name('admin.usuarios.edit');
    Route::put('{usuario}', 'update') -> name('admin.usuarios.update');
});

// grupo de rutas para las reseñas
Route::controller(AdminReseniaController::class) -> prefix('resenias') -> group(function() {
    Route::get('', 'index') -> name('admin.resenias.index');
    Route::get('{resenia}', 'show') -> name('admin.resenias.show');
    Route::delete('{resenia}', 'destroy') -> name('admin.resenias.destroy');
});
