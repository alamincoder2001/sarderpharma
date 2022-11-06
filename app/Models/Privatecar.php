<?php

namespace App\Models;

use Devfaysal\BangladeshGeocode\Models\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privatecar extends Model
{
    use HasFactory;

    protected $fillable = ["*"];

    public function city()
    {
        return $this->belongsTo(District::class);
    }

    // public static function cartype($id){
    //     $car =  explode(",", $id);
    //     $data = "";
    //     foreach($car as $item){
    //         $data .= Cartype::where("name", $item)->pluck("name")->first().", ";
    //     }
    //     return $data;
    // }
}
