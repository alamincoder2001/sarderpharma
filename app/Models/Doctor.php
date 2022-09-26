<?php

namespace App\Models;

use Devfaysal\BangladeshGeocode\Models\District;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory ;

    protected $fillable = [
        "name",
        "username",
        "education",
        "speciality",
        "image",
        "availability",
        "from",
        "to",
        "phone",
        "email",
        "password",
        "city_id",
        "first_fee",
        "second_fee"
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class,"department_id");
    }
    public function city()
    {
        return $this->belongsTo(District::class,"city_id");
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class,"hospital_id");
    }
    public function diagnostic()
    {
        return $this->belongsTo(Diagnostic::class,"diagnostic_id");
    }
}
