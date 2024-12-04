<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\VerificarCuentaController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Usuario\HomeController;
use App\Models\Estado;
use App\Models\Zona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;


Route::get('mail', function() {
    return view('admin.emails.emailVerificarCuenta');
});

/*
    ______________________
                            RUTAS   DEL    USUARIO
                                                    ____________________
                                                                            */

Route::prefix('/')
    -> group(function() {

    //  componente perfil
    Route::get('perfil', function(){
        return view('usuario.perfil.perfil');
    }) -> middleware(['role:1']) -> name('perfil');

    Route::get('culturas', function(){
        return view('usuario.culturas.culturas');
    }) -> name('culturas');

    Route::get('cultura/{id}', function($id){
        return view('usuario.culturas.culturas-show', compact('id'));
    }) -> name('cultura.show');

    Route::get('estados', function(){
        return view('usuario.estados.estados');
    }) -> name('estados');

    Route::get('estados/{slug}', function($slug){
        $estado = Estado::where('slug', $slug) -> first();
        return view('usuario.estados.estados-show', compact('estado'));
    }) -> name('estado.show');

    Route::get('estados/{slug}/culturas', function($slug){
        $estado = Estado::where('slug', $slug) -> first();
        return view('usuario.culturas-estados', compact('estado'));
    }) -> name('culturas-estados');

    Route::get('estados/{slug}/zonas-arqueologicas', function($slug){
        $estado = Estado::where('slug', $slug) -> first();
        return view('usuario.zonas-estados', compact('estado'));
    }) -> name('zonas-estados');

    Route::get('estados/{slug_estado}/{slug_zona}', function($slug_estado, $slug_zona){
        $estado = Estado::where('slug', $slug_estado) -> first();
        $zona = Zona::where('slug', $slug_zona) -> first();
        return view('usuario.zonas.zonas-show', compact('estado', 'zona'));
    }) -> name('zona-estado.show'); 

    Route::get('zonas', function(){
        return view('usuario.zonas.zonas');
    }) -> name('zonas');

    Route::get('zonas/{slug}', function($slug){
        $zona = Zona::where('slug', $slug) -> first();
        return view('usuario.zonas.zonas-show', compact('zona'));
    }) -> name('zona.show');

    Route::get('quizz', function(){
        return view('usuario.quizz.quizz');
    }) -> name('quizz');

    Route::get('foro', function(){
        return view('usuario.foro.foro');
    }) -> name('foro');

    Route::get('contactanos', function(){
        return view('usuario.contactanos');
    }) -> name('contactanos');

    Route::controller(HomeController::class)
        -> group(function() {

        Route::get('', 'home') -> name('home');

        Route::get('mapa-estados', 'mapa_estados_index')
            -> name('mapa_estados.index');

        Route::get('mapa-zonas', 'mapa_zonas_index')
            -> name('mapa_zonas.index');

        Route::get('nosotros', 'nosotros_index')
            -> name('nosotros.index');
    });

});














/*
    _____________________
                            RUTAS   PARA    AUTH
                                                    __________________
                                                                            */
                                                                            // componente de registro
Route::get('register', function() {
    return view('auth.register');
}) -> middleware('guest') -> name('register');

// componente loggin
Route::get('login', function() {
    return view('auth.login');
}) -> middleware('guest') -> name('login');

// logout
Route::post('logout',  function() {
    Auth::logout();
    session() -> invalidate();
    session() -> regenerateToken();
    return redirect() -> route('login');
}) -> name('logout');

Route::controller(GoogleAuthController::class)
    -> prefix('auth/google')
    -> group(function() {

    Route::get('', 'redirect') -> name('google-auth');
    Route::get('call-back',  'callbackGoogle');
});














/*
    ______________________
                            RUTAS   DEL    ADMIM
                                                    ____________________
                                                                            */
Route::prefix('admin')
    -> middleware(['auth', 'role:2'])
    -> group(function () {

        // vistas que llaman a los componentes livewire
        Route::get('culturas', function () {
            return view('admin.livewire.culturas');
        }) -> name('admin.culturas');

        Route::get('estados', function () {
            return view('admin.livewire.estados');
        }) -> name('admin.estados');

        Route::get('zonas', function () {
            return view('admin.livewire.zonas');
        }) -> name('admin.zonas');

        Route::get('resenias', function () {
            return view('admin.livewire.resenias');
        }) -> name('admin.resenias');

        Route::get('usuarios', function () {
            return view('admin.livewire.usuarios');
        }) -> name('admin.usuarios');

        Route::get('migrations', function () {
            return view('admin.livewire.migrations');
        }) -> name('admin.migrations');

        Route::get('culturas-estados', function () {
            return view('admin.livewire.culturas-estados');
        }) -> name('admin.culturas_estados');

        Route::get('culturas-fotos', function () {
            return view('admin.livewire.culturas-fotos');
        }) -> name('admin.culturas_fotos');

        // vistas sin reactibidad
        Route::controller(AdminHomeController::class) -> group(function () {
            Route::get('dashboard', 'dashboard') -> name('dashboard');

            Route::get('database', 'database') -> name('database');

            Route::get('ubicaciones-zonas', 'ubicaciones_zonas')-> name('admin.ubicaciones_zonas');

            Route::get('ubicaciones-estados', 'ubicaciones_estados')-> name('admin.ubicaciones_estados');

            Route::get('resenias-imagenes', 'resenias_imagenes')-> name('admin.resenias_fotos');

            Route::get('roles', 'roles')-> name('admin.roles');

            Route::get('zonas-imagenes', 'zonas_imagenes')-> name('admin.zonas_fotos');
        });

    });





Route::fallback(function () {
    return response()->json([
        'error' => 'Resource not found.'
    ], 404);
});


// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post('/livewire/update', $handle);
// });
