<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;
use App\Models\CulturaEstado;
use App\Models\CulturaImagen;
use App\Models\ReseniaImagen;
use App\Models\Rol;
use App\Models\UbicacionEstado;
use App\Models\UbicacionZona;
use App\Models\ZonaImagen;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public $query = '';
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('admin.dashboard');
    }

    // public function database() {
    //     $tables = DB::select('SHOW TABLES');
    //     $database_name = env('DB_DATABASE');
    //     $column_name = "Tables_in_{$database_name}";

    //     $tables_with_counts = [];

    //     foreach($tables as $table):
    //         $table_name = $table -> $column_name;
    //         $table_count = DB::table($table_name) -> count();

    //         $tables_with_counts[] = [
    //             'name' => $table_name,
    //             'count' => $table_count,
    //         ];
    //     endforeach;

    //     return view('admin.database', [
    //         'tables_and_counts' => $tables_with_counts,
    //         'tables_count' => count($tables_with_counts),
    //         'database_name' => $database_name
    //     ]);
    // }

    public function database() {
        $tables = DB::select('SHOW TABLES');
        $database_name = env('DB_DATABASE');
        $Tables_in = "Tables_in_{$database_name}";

        $tables_with_counts = [];

        foreach ($tables as $table) {
            $table_name = $table -> $Tables_in;

            $table_count = DB::table($table_name) -> count();

            $tables_with_counts[] = [
                'name' => $table_name,
                'count' => $table_count,
            ];
        }

        return view('admin.database', [
            'tables_and_counts' => $tables_with_counts,
            'tables_count' => count($tables_with_counts),
            'database_name' => $database_name,
        ]);
    }

    public function migraciones() {
        $migrations = DB::table('migrations')
                        -> paginate(5, pageName:'pageMigrations');

        $keys = Schema::getColumnListing('migrations');
        // dd($keys);
        return view('admin.migrations', compact('migrations', 'keys'));
    }

    public function roles() {
        $roles = Rol::paginate();

        return view('admin.roles', compact('roles'));
    }

    public function culturas_estados() {
        $cultures_states = CulturaEstado::paginate();

        return view('admin.culturas-estados', compact('cultures_states'));
    }

    public function zonas_imagenes() {
        $zones_images = ZonaImagen::paginate();

        return view('admin.zonas-imagenes', compact('zones_images'));
    }

    public function resenias_imagenes() {
        $reviews_images = ReseniaImagen::paginate();

        return view('admin.resenias-imagenes', compact('reviews_images'));
    }

    public function culturas_imagenes() {
        $cultures_images = CulturaImagen::paginate();

        return view('admin.culturas-imagenes', compact('cultures_images'));
    }

    public function ubicaciones_zonas() {
        $zones_locations = UbicacionZona::paginate();

        return view('admin.ubicaciones-zonas', compact('zones_locations'));
    }

    public function ubicaciones_estados() {
        $states_locations = UbicacionEstado::paginate();

        return view('admin.ubicaciones-estados', compact('states_locations'));
    }

}

