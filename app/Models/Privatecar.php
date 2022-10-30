<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privatecar extends Model
{
    use HasFactory;

    protected $fillable = ["*"];

    public static function cartype($id){
        $car =  explode(",", $id);
        $data = "";
        foreach($car as $item){
            $data .= Cartype::where("id", $item)->pluck("name")->first().", ";
        }
        return $data;
    }
}
