<?php

namespace App\Http\Controllers\Hospital;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hospital');
    }

    public function index()
    {
        $id = Auth::guard("hospital")->user()->id;
        $doctors = Doctor::with("department")->where("hospital_id", $id)->get();
        return view("hospital.doctor.index", compact('doctors'));
    }
    public function create()
    {
        $departments = Department::all();
        return view("hospital.doctor.create", compact("departments"));
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => "required|max:255",
                'username' => "required|unique:doctors",
                'email' => "required",
                'education' => "required|max:255",
                'department_id' => "required",
                'availability' => "required",
                'password' => "required",
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
                $data->city_id = Auth::guard("hospital")->user()->city_id;
                $data->availability = implode(",", $request->availability);
                $data->to = $request->to;
                $data->from = $request->from;
                $data->phone = $request->phone;
                $data->first_fee = $request->first_fee;
                $data->second_fee = $request->second_fee;
                $data->hospital_id = Auth::guard("hospital")->user()->id;
                $data->save();
                return response()->json("Doctor addedd successfully");
            }
        }catch(\Throwable $e){
            return response()->json("Something went wrong");
        }
    }

    public function edit($id)
    {
        $departments = Department::all();
        $data = DB::table("doctors")->where("id", $id)->first();
        $avail = explode(",", $data->availability);
        return view("hospital.doctor.edit", compact("data", 'avail',"departments"));
    }

    public function update(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => "required|max:255",
                'username' => "required|unique:doctors,username,".$request->id,
                'email' => "required",
                'education' => "required|max:255",
                'department_id' => "required",
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
                    $data->email = Hash::make($request->password);
                }
                
                $data->education = $request->education;
                $data->department_id = $request->department_id;
                $data->city_id = Auth::guard("hospital")->user()->city_id;
                $data->availability = implode(",", $request->availability);
                $data->to = $request->to;
                $data->from = $request->from;
                $data->phone = $request->phone;
                $data->first_fee = $request->first_fee;
                $data->second_fee = $request->second_fee;
                $data->hospital_id = Auth::guard("hospital")->user()->id;
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
}
