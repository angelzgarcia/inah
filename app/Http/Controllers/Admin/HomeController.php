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

class HomeController extends Controller
{
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

        $tables_with_counts = [];

        foreach ($tables as $table) {
            $table_name = $table->Tables_in_inah;

            $table_count = DB::table($table_name)->count();

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


    public function migrations() {
        return view('admin.database');
    }

    public function roles() {
        $roles = Rol::paginate();

        return view('admin.roles.index', compact('roles'));
    }

    public function cultures_states() {
        $cultures_states = CulturaEstado::paginate();

        return view('admin.culturas-estados.index', compact('cultures_states'));
    }

    public function zones_images() {
        $zones_images = ZonaImagen::paginate();

        return view('admin.zonas-imagenes.index', compact('zones_images'));
    }

    public function reviews_images() {
        $reviews_images = ReseniaImagen::paginate();

        return view('admin.resenias-imagenes.index', compact('reviews_images'));
    }

    public function cultures_images() {
        $cultures_images = CulturaImagen::paginate();

        return view('admin.culturas-imagenes.index', compact('cultures_images'));
    }

    public function zones_locations() {
        $zones_locations = UbicacionZona::paginate();

        return view('admin.ubicaciones-zonas.index', compact('zones_locations'));
    }

    public function states_locations() {
        $states_locations = UbicacionEstado::paginate();

        return view('admin.ubicaciones-estados.index', compact('states_locations'));
    }

}
