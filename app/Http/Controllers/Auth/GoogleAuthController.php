<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('google') -> redirect();
    }

    public function callbackGoogle() {
        try {
            $google_user = Socialite::driver('google') -> user();

            $user = Usuario::where('google_id', $google_user -> getId())
                            -> where('email', $google_user -> getEmail())
                            -> first();

            if (!$user):
                $new_user = Usuario::create([
                    'google_id' => $google_user -> getId(),
                    'nombre' => $google_user -> getName(),
                    'genero' => null,
                    'foto' => $google_user -> getAvatar(),
                    'email' => $google_user -> getEmail(),
                    'numero' => null,
                    'password' => null,
                    'token' => null,
                    'confirmado' => 1,
                    'status' => 'activo',
                    'idRol' => 1,
                ]);

                Auth::login($new_user);

                return redirect() -> route('perfil');

            else:
                Auth::login($user);

                if ($user -> confirmado == 1 && $user -> status == 'activo' && $user -> idRol == 2)
                    return redirect() -> route('admin/dashboard');

                return redirect() -> route('perfil');
            endif;

        } catch (\Throwable $th) {
            dd('Ocurrió un error ' . $th -> getMessage());
        }
    }
}
