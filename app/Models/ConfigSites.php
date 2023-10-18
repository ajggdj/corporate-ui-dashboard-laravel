<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigSites extends Model
{
    use HasFactory;
    protected $table = 'config_sites';

    public static function logo(){
        return $idImagen = ConfigSites::where('nombre','logo');
    }


}
