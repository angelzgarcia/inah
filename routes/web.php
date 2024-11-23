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
use App\Livewire\Auth\LogginComponent;
use App\Livewire\Auth\LoginComponent;
use App\Livewire\Auth\RegisterComponent;
use App\Livewire\Usuario\Culturas\CulturasComponent;
use App\Livewire\Usuario\Estados\EstadosComponent;
use App\Livewire\Usuario\Foro\ForoComponent;
use App\Livewire\Usuario\Quizz\QuizzComponent;
use App\Livewire\Usuario\Zonas\ZonasComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
    ______________________
                            RUTAS   DEL    USUARIO
                                                    ____________________
                                                                            */

Route::controller(HomeController::class) -> prefix('/') -> group(function() {
    Route::get('/', 'index') -> name('home');
    Route::get('mapa-estados', 'mapa_estados_index') -> name('mapa_estados.index');
    Route::get('mapa-zonas', 'mapa_zonas_index') -> name('mapa_zonas.index');
    Route::get('nosotros', 'nosotros_index') -> name('nosotros.index');
});

// rutas componente perfil
Route::get('perfil', function(){
    return view('usuario.perfil.perfil');
}) -> middleware(['role:1']) -> name('perfil');

// rutas componentes culturas
Route::get('culturas', function(){
    return view('usuario.culturas.culturas');
}) -> name('culturas');

Route::get('cultura/{id}', function($id){
    return view('usuario.culturas.culturas-show', compact('id'));
}) -> name('cultura.show');

// rutas componentes estados
Route::get('estados', function(){
    return view('usuario.estados.estados');
}) -> name('estados');

Route::get('estados/{id}', function($id){
    return view('usuario.estados.estados-show');
}) -> name('estado.show');

// rutas componentes zonas
Route::get('zonas', function(){
    return view('usuario.zonas.zonas');
}) -> name('zonas');

Route::get('zonas/{id}', function($id){
    return view('usuario.zonas.zonas-show');
}) -> name('zona.show');

// rutas componentes quizz
Route::get('quizz', function(){
    return view('usuario.quizz.quizz');
}) -> name('quizz');

// rutas componentes foro
Route::get('foro', function(){
    return view('usuario.foro.foro');
}) -> name('foro');

// rutas componentes contactanos
Route::get('contactanos', function(){
    return view('usuario.contactanos');
}) -> name('contactanos');







/*
    _____________________
                            RUTAS   PARA    AUTH
                                                    __________________
                                                                            */

// auth google
Route::get('auth/google', [GoogleAuthController::class, 'redirect']) -> name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

// ruta del componente loggin
Route::get('login', function() {
    return view('auth.login');
}) -> middleware('guest') -> name('login');

// ruta del componente de registro
Route::get('register', function() {
    return view('auth.register');
}) -> middleware('guest') -> name('register');













/*
    ______________________
                            RUTAS   DEL    ADMIM
                                                    ____________________
                                                                            */
Route::prefix('admin')
    -> middleware(['auth', 'role:2'])
    -> group(function () {

        Route::controller(AdminHomeController::class)->group(function () {
            Route::get('dashboard', 'index')->name('dashboard');
            Route::get('database', 'database')->name('database');
            Route::get('migraciones', 'migraciones')->name('admin.migrations');
            Route::get('roles', 'roles')->name('admin.roles');
            Route::get('culturas-estados', 'culturas_estados')->name('admin.culturas_estados');
            Route::get('zonas-imagenes', 'zonas_imagenes')->name('admin.zonas_fotos');
            Route::get('resenias-imagenes', 'resenias_imagenes')->name('admin.resenias_fotos');
            Route::get('culturas-imagenes', 'culturas_imagenes')->name('admin.culturas_fotos');
            Route::get('ubicaciones-zonas', 'ubicaciones_zonas')->name('admin.ubicaciones_zonas');
            Route::get('ubicaciones-estados', 'ubicaciones_estados')->name('admin.ubicaciones_estados');
        });

        Route::get('culturas', function () {
            return view('admin.culturas');
        })->name('admin.culturas');

        Route::get('estados', function () {
            return view('admin.estados');
        })->name('admin.estados');

        Route::get('zonas', function () {
            return view('admin.zonas');
        })->name('admin.zonas');

        Route::get('resenias', function () {
            return view('admin.resenias');
        })->name('admin.resenias');

        Route::get('usuarios', function () {
            return view('admin.usuarios');
        })->name('admin.usuarios');

        Route::controller(VerificarCuentaController::class) -> prefix('verificar-administrador') -> group(function() {
            Route::get('', 'index') -> name('admin.verificar_cuenta.index');
            Route::put('',  'verify') -> name('admin.verificar_cuenta.verify');
            Route::put('update', 'update') -> name('admin.verificar_cuenta.update');
        });

        Route::post('logout',  function() {
            Auth::logout();
            session() -> invalidate();
            session() -> regenerateToken();

            return redirect() -> route('login');
        }) -> name('logout');


        // Route::fallback(function () {
        //     return response()->view('errors.404', [], 404);
        // });
    });


