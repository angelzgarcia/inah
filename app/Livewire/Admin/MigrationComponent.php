<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class MigrationComponent extends Component
{
    public
    $openShow = false,
    $perPage = 5,
    $query = '',
    $sortColumn = 'id',
    $sortDirection = 'desc',
    $migracion;

    public function render()
    {
        $migrations = DB::table('migrations')
                        -> where('id', 'like', "%{$this->query}%")
                        -> orWhere('migration', 'like', "%{$this->query}%")
                        -> orderBy($this->sortColumn, $this->sortDirection)
                        -> paginate($this -> perPage < 1 ? 5 : $this -> perPage, pageName:'pageMigrations');

        $keys = Schema::getColumnListing('migrations');

        return view('livewire.admin.migration-component', compact('migrations', 'keys'));
    }

    public function show($idMigracion)
    {
        $this -> migracion = DB::table('migrations')
                        -> where('id', $idMigracion)
                        -> first();

        $this -> openShow = true;
    }

    public function sortBy($idColumnName)
    {
        if ($this -> sortColumn == $idColumnName) {
            $this -> sortDirection = $this -> sortDirection == 'desc' ? 'asc' : 'desc';
        } else {
            $this -> sortColumn = $idColumnName;
            $this -> sortDirection = 'desc';
        }
    }

    public function redirigir($route)
    {
        return $this -> redirect(route($route), navigate: true);
    }
}
