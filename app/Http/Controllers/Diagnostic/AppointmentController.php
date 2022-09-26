<?php

namespace App\Http\Controllers\Diagnostic;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:diagnostic');
    }

    public function index()
    {
        $diagnostic = Auth::guard("diagnostic")->user();
        $data["appointment"] = Appointment::where("diagnostic_id", $diagnostic->id)->get();
        return view("diagnostic.patient.index", compact("data"));
    }

    public function patient($id)
    {
        $patients = Appointment::find($id);
        return view("diagnostic.patient.patient", compact("patients"));
    }

    public function comment(Request $request)
    {
        try{
            $data = Appointment::find($request->id);
            $data->comment = $request->comment;
            $data->update();
            return response()->json("Diagnostic comment on patient successfull");
        }catch(\Throwable $e){
            return response()->json("Something went wrong");
        }
    }
}
