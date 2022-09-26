<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $doctors = Doctor::with("department")->latest()->get();
        return view("admin.doctor.index", compact('doctors'));
    }
    public function create()
    {
        $hospitals = DB::table("hospitals")->orderBy("id", "DESC")->get();
        $departments = DB::table("departments")->orderBy("id", "DESC")->get();
        $diagnostics = DB::table("diagnostics")->orderBy("id", "DESC")->get();
        return view("admin.doctor.create", compact("hospitals", "diagnostics","departments"));
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => "required|max:255",
                'email' => "required|email",
                'education' => "required",
                'password' => "required",
                'username' => "required|unique:hospitals",
                'department_id' => "required",
                'city_id' => "required",
                'availability' => "required",
                'to' => "required",
                'from' => "required",
                'phone' => "required|min:11|max:15",
                'first_fee' => "required|numeric",
                'second_fee' => "required|numeric",
            ]);

            if($validator->fails()){
                return response()->json(["error" => $validator->errors()]);
            }else{
                $data = new Doctor;
                $data->image = $this->imageUpload($request, 'image', 'uploads/doctor') ?? '';
                $data->name = $request->name;
                $data->username = $request->username;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);

                $data->education = $request->education;
                $data->department_id = $request->department_id;
                $data->city_id = $request->city_id;
                $data->availability = implode(",", $request->availability);
                $data->to = $request->to;
                $data->from = $request->from;
                $data->phone = $request->phone;
                $data->first_fee = $request->first_fee;
                $data->second_fee = $request->second_fee;
                if(!empty($request->chamber_name)){
                    $data->chamber_name = $request->chamber_name;
                    $data->address = $request->address;
                }
                if(!empty($request->hospital_id)){
                    $data->hospital_id = implode(",", $request->hospital_id);
                }
                if(!empty($request->diagnostic_id)){
                    $data->diagnostic_id = implode(",", $request->diagnostic_id);
                }
                $data->save();
                return response()->json("Doctor addedd successfully");
            }
        }catch(\Throwable $e){
            return response()->json("Something went wrong");
        }
    }

    public function edit($id)
    {
        $data = DB::table("doctors")->where("id", $id)->first();
        $avail = explode(",", $data->availability);
        $hospitals = DB::table("hospitals")->orderBy("id", "DESC")->get();
        $departments = DB::table("departments")->orderBy("id", "DESC")->get();
        $diagnostics = DB::table("diagnostics")->orderBy("id", "DESC")->get();
        return view("admin.doctor.edit", compact("data", 'avail', "hospitals", "diagnostics", "departments"));
    }

    public function update(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => "required|max:255",
                'email' => "required|email",
                'education' => "required",
                'username' => "required|unique:hospitals,username,".$request->id,
                'department_id' => "required",
                'city_id' => "required",
                'availability' => "required",
                'to' => "required",
                'from' => "required",
                'phone' => "required|min:11|max:15",
                'first_fee' => "required|numeric",
                'second_fee' => "required|numeric",
            ]);

            if($validator->fails()){
                return response()->json(["error" => $validator->errors()]);
            }else{
                $data = Doctor::find($request->id);
                $old  = $data->image;
                if ($request->hasFile('image')) {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                    $data->image = $this->imageUpload($request, 'image', 'uploads/doctor') ?? '';
                }
                $data->name = $request->name;
                $data->username = $request->username;
                $data->email = $request->email;
                if(!empty($request->password)){
                    $data->password = Hash::make($request->password);
                }
                $data->education = $request->education;
                $data->city_id = $request->city_id;
                $data->department_id = $request->department_id;
                $data->availability = implode(",", $request->availability);
                $data->to = $request->to;
                $data->from = $request->from;
                $data->phone = $request->phone;
                $data->first_fee = $request->first_fee;
                $data->second_fee = $request->second_fee;
                $data->chamber_name = $request->chamber_name;
                $data->address = $request->address;                
                if(!empty($request->hospital_id)){
                    $data->hospital_id = implode(",", $request->hospital_id);
                }
                if(!empty($request->diagnostic_id)){
                    $data->diagnostic_id = implode(",", $request->diagnostic_id);
                }                         
                
                $data->update();
                return response()->json("Doctor updated successfully");
            }
        }catch(\Throwable $e){
            return response()->json("Something went wrong");
        }
    }

    public function destroy(Request $request)
    {
        try{
            $data = Doctor::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return response()->json("Doctor deleted successfully");
        }catch(\Throwable $e){
            return response()->json("Something went wrong");
        }
    }

    // doctor patient appointment
    public function appointment($id)
    {
        $appointments = Appointment::where("doctor_id", $id)->get();
        return view("admin.doctor.appointment", compact("appointments"));
    }
}
