<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hospital');
    }

    public function index()
    {
        $hospital = Auth::guard("hospital")->user();
        $data["appointment"] = Appointment::where("hospital_id", $hospital->id)->get();
        return view("hospital.patient.index", compact("data"));
    }

    public function patient($id)
    {
        $patients = Appointment::find($id);
        return view("hospital.patient.patient", compact("patients"));
    }

    public function comment(Request $request)
    {
        try{
            $data = Appointment::find($request->id);
            $data->comment = $request->comment;
            $data->update();
            return response()->json("Hospital comment on patient successfull");
        }catch(\Throwable $e){
            return response()->json("Something went wrong");
        }
    }
}
