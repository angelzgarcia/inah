<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Estado extends Model
{
    use HasFactory;

    protected $primaryKey = 'idEstadoRepublica';

    // protected $fillable = [];
    protected $guarded = [''];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function($estado) {
            if (!$estado->slug) {
                $estado->slug = Str::slug($estado->nombre, '-');
            }
        });
    }

    public function ubicacion() {
        return $this -> hasOne(UbicacionEstado::class, 'idEstadoRepublica', 'idEstadoRepublica');
    }

    public function zonas() {
        return $this -> hasMany(Zona::class, 'idEstadoRepublica', 'idEstadoRepublica');
    }

    public function culturas() {
        return $this -> belongsToMany(Cultura::class);
    }

    // MUTADORES Y ACCESORES
    protected function nombre(): Attribute {
        return new Attribute(
            set: fn($name) => strtolower($name),
            get: fn($name) => ucwords($name)
        );
    }

    protected function capital(): Attribute {
        return new Attribute(
            set: fn($capital) => strtolower($capital),
            get: fn($capital) => ucwords($capital)
        );
    }

    protected function video()
    {
        return new Attribute(
            set: fn($video) => strtolower($video),
            get: fn($video) => strtolower($video),
        );
    }

}
