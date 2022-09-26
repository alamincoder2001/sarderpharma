<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Slider;
use App\Models\Partner;
use App\Models\Hospital;
use App\Models\Ambulance;
use App\Models\Department;
use App\Models\Diagnostic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    // frontend section
    public function index()
    {
        $data['department'] = Department::all();
        $data['slider'] = Slider::latest()->limit(4)->get();
        $data['partner'] = Partner::latest()->get();
        $data["doctor"] = Doctor::with("city", "hospital", "diagnostic", "department")->latest()->limit(8)->get();
        return view('website', compact("data"));
    }
    //doctor
    public function doctor()
    {
        $data['doctor'] = Doctor::latest("id")->paginate(15);
        $data['department'] = Department::all();
        return view('doctor_details', compact("data"));
    }
    //hospital
    public function hospital()
    {
        $data['hospital'] = Hospital::latest("id")->paginate(15);
        return view('hospital_details', compact("data"));
    }
    //diagnostic
    public function diagnostic()
    {
        $data['diagnostic'] = Diagnostic::latest("id")->paginate(15);
        return view('diagnostic_details', compact("data"));
    }
    //ambulance
    public function ambulance()
    {
        $data['ambulance'] = Ambulance::latest("id")->paginate(15);
        return view('ambulance_details', compact("data"));
    }


    // single doctor
    public function singledoctor($id = null)
    {
        $data = Doctor::find($id);
        return view("doctor_single_page", compact("data"));
    }
    // get hospital and diagnostic by doctor id
    public function SingleHospitalDignostic(Request $request)
    {
        try {
            if ($request->name == "hospital") {
                $doctor = Doctor::find($request->id);
                $hosp_id = explode(",", $doctor->hospital_id);
                $data = [];
                foreach ($hosp_id as $key => $h) {
                    $data[$key] = Hospital::where("id", $h)->first();
                }
            } else if ($request->name == "diagnostic") {
                $doctor = Doctor::find($request->id);
                $diag_id = explode(",", $doctor->diagnostic_id);
                $data = [];
                foreach ($diag_id as $key => $d) {
                    $data[$key] = Diagnostic::where("id", $d)->first();
                }
            } else {
                $doctor =  Doctor::find($request->id);
                if (!empty($doctor->chamber_name)) {
                    $d = ["id" => $doctor->id, "chamber_name" => $doctor->chamber_name, "address" => $doctor->address];
                    $data = ["0" => $d];
                } else {
                    $data = ["null" => 0];
                }
            }
            if ($data[0] !== null) {
                return response()->json($data);
            } else {
                return response()->json(["null" => "Not Found Data"]);
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }
    // single hospital
    public function singlehospital($id = null)
    {
        $data = Hospital::find($id);
        $related = Doctor::where("hospital_id", $id)->get();
        $departments = Department::all();
        return view("hospital_single_page", compact("data", "related", "departments"));
    }
    // single diagnostic
    public function singlediagnostic($id = null)
    {
        $data = Diagnostic::find($id);
        $related = Doctor::where("hospital_id", $id)->get();
        $departments = Department::all();
        return view("diagnostic_single_page", compact("data", "related", "departments"));
    }
    // single ambulance
    public function singleambulance($id = null)
    {
        $data = Ambulance::find($id);
        return view("ambulance_single_page", compact("data"));
    }

    // home filter
    public function filter(Request $request)
    {
        try {
            if ($request->department_id) {
                $data = Doctor::with("city", "hospital", "diagnostic", "department")->where("department_id", $request->department_id)->get();
            } else {
                $data = Doctor::with("city", "hospital", "diagnostic", "department")->latest()->limit(8)->get();
            }
            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json("Something went wrong" . $e->getMessage());
        }
    }
}
