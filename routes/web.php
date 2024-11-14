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
use App\Livewire\Admin\CulturaWire;
use App\Livewire\Admin\EstadoWire;
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
    Route::get('database',  'database') -> name('database');
    Route::get('migraciones',  'migraciones') -> name('admin.migrations');
    Route::get('roles',  'roles') -> name('admin.roles');
    Route::get('culturas-estados',  'culturas_estados') -> name('admin.culturas_estados');
    Route::get('zonas-imagenes', 'zonas_imagenes') -> name('admin.zonas_fotos');
    Route::get('resenias-imagenes', 'resenias_imagenes') -> name('admin.resenias_fotos');
    Route::get('culturas-imagenes', 'culturas_imagenes') -> name('admin.culturas_fotos');
    Route::get('ubicaciones-zonas', 'ubicaciones_zonas') -> name('admin.ubicaciones_zonas');
    Route::get('ubicaciones-estados', 'ubicaciones_estados') -> name('admin.ubicaciones_estados');
});

//
Route::controller(VerificarCuentaController::class) -> prefix('verificar-administrador') -> group(function() {
    Route::get('', 'index') -> name('admin.verificar_cuenta.index');
    Route::put('',  'verify') -> name('admin.verificar_cuenta.verify');
    Route::put('update', 'update') -> name('admin.verificar_cuenta.update');
});

// ruta para el componente de las culturas
Route::get('admin/culturas', function(){
    return view('admin.culturas');
}) -> name('admin.culturas');

// ruta para el componente de los estados
Route::get('admin/estados', function() {
    return view('admin.estados');
}) -> name('admin.estados');

// ruta para el componente de las zonas
Route::get('admin/zonas', function() {
    return view('admin.zonas');
}) -> name('admin.zonas');

// ruta para las reseñas
Route::controller(AdminReseniaController::class) -> prefix('resenias') -> group(function() {
    Route::get('', 'index') -> name('admin.resenias');
});

// ruta para el componente de los administradores
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
    Route::get('', 'index')-> name('admin.usuarios');
});


