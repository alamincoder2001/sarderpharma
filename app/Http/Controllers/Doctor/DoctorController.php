<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Diagnostic;
use App\Models\Hospital;
use Devfaysal\BangladeshGeocode\Models\District;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }

    public function index()
    {
        $doctor = Auth::guard("doctor")->user();
        $data["new"] = Appointment::where(["doctor_id" => $doctor->id, "appointment_date" => date("d/m/Y")])->get();
        return view("doctor.dashboard", compact("data"));
    }
    public function doctor()
    {
        $doctor = Auth::guard("doctor")->user();
        $data['department'] = Department::all();
        $data['hospital_id'] = explode(",", $doctor->hospital_id);
        $data['diagnostic_id'] = explode(",", $doctor->diagnostic_id);
        $hospitals = Hospital::all();
        $diagnostics = Diagnostic::all();
        $data["new"] = Appointment::where(["doctor_id" => $doctor->id, "appointment_date" => date("d/m/Y")])->get();
        return view("doctor.profile", compact("data", "diagnostics", "hospitals"));
    }

    

    public function update(Request $request)
    {
        try {
            $data = Auth::guard("doctor")->user();
            $validator = Validator::make($request->all(), [
                'name' => "required|max:255",
                'username' => "required|unique:doctors,username," . $data->id,
                'email' => "required|email",
                'education' => "required|max:255",
                'department_id' => "required",
                'to' => "required",
                'from' => "required",
                'phone' => "required|min:11|max:15",
                'first_fee' => "required|numeric",
                'second_fee' => "required|numeric",
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            } else {
                $data->name = $request->name;
                $data->username = $request->username;
                $data->email = $request->email;
                $data->education = $request->education;
                $data->department_id = $request->department_id;
                $data->to = $request->to;
                $data->from = $request->from;
                $data->phone = $request->phone;
                $data->first_fee = $request->first_fee;
                $data->second_fee = $request->second_fee;
                $data->chamber_name = $request->chamber_name;
                $data->address = $request->address;
                $data->availability = implode(",", $request->availability);
                if (!empty($request->hospital_id)) {
                    $data->hospital_id = implode(",", $request->hospital_id);
                }
                if (!empty($request->diagnostic_id)) {
                    $data->diagnostic_id = implode(",", $request->diagnostic_id);
                }
                $data->update();
                return response()->json("Doctor Profile updated");
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong" . $e->getMessage());
        }
    }

    public function password()
    {
        $doctor = Auth::guard("doctor")->user();
        $data["new"] = Appointment::where(["doctor_id" => $doctor->id, "appointment_date" => date("d/m/Y")])->get();
        return view("doctor.password", compact("data"));
    }


    public function passwordUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "password" => "required",
                "new_password" => "required|same:confirm_password",
                "confirm_password" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            } else {
                $data = Auth::guard("doctor")->user();
                $hashpass = $data->password;
                if (Hash::check($request->password, $hashpass)) {
                    $data->password = Hash::make($request->new_password);
                    $data->update();
                    return response()->json("Password Change Successfully");
                } else {
                    return response()->json("Current Password does not match");
                }
            }
        } catch (\Throwable $e) {
            return response()->json("something went wrong");
        }
    }

    public function imageUpdate(Request $request)
    {
        try {
            $data = Auth::guard("doctor")->user();
            $old  = $data->image;
            if ($request->hasFile('image')) {
                if (File::exists($old)) {
                    File::delete($old);
                }
                $data->image = $this->imageUpload($request, 'image', 'uploads/doctor') ?? '';
                $data->update();
                return response()->json("Doctor Image updated");
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }

    public function doctorAppointment()
    {
        $id = Auth::guard("doctor")->user()->id;
        $data["all"] = Appointment::where(["doctor_id" => $id])->get();
        $data["new"] = Appointment::where(["doctor_id" => $id, "appointment_date" => date("d/m/Y")])->get();
        return view("doctor.appointment.index", compact("data"));
    }

    public function doctorPatient($id)
    {
        $ids = Auth::guard("doctor")->user()->id;
        $data["new"] = Appointment::where(["doctor_id" => $ids, "appointment_date" => date("d/m/Y")])->get();
        $patients = Appointment::find($id);
        return view("doctor.appointment.patient", compact("data", "patients"));
    }

    public function comment(Request $request)
    {
        try{
            $data = Appointment::where("id", $request->id)->first();
            $data->comment = $request->comment;
            $data->update();
            return response()->json("Comment Send Successfully");
        }catch(\Throwable $e){
            return response()->json("Something went wrong".$e->getMessage());
        }
    }
}
