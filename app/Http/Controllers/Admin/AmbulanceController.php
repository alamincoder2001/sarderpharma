<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ambulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AmbulanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $ambulances = DB::table("ambulances")->orderBy("id", 'DESC')->get();
        return view("admin.ambulance.index", compact("ambulances"));
    }

    public function create()
    {
        return view("admin.ambulance.create");
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "username" => "required|unique:ambulances",
                "email" => "required|email",
                "password" => "required",
                "phone" => "required|min:11|max:15",
                "city_id" => "required",
                "ambulance_type" => "required",
                "address" => "required",
            ]);

            if($validator->fails()){
                return response()->json(["error"=>$validator->errors()]);
            }else{
                $data = new Ambulance;
                $data->image = $this->imageUpload($request, 'image', 'uploads/ambulance') ?? '';
                $data->name = $request->name;
                $data->username = $request->username;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->ambulance_type =implode(",",$request->ambulance_type);
                $data->phone = $request->phone;
                $data->city_id = $request->city_id;
                $data->address = $request->address;
                if(!empty($request->map_link)){
                    $data->map_link = $request->map_link;
                }
                $data->save();
                return response()->json("ambulance added successfully");
            }
        }catch(\Throwable $e){
            return response()->json("something went wrong");
        }
    }

    public function edit($id)
    {
        $data = Ambulance::find($id);
        return view("admin.ambulance.edit", compact('data'));
    }

    public function update(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "username" => "required|unique:ambulances,username,".$request->id,
                "email" => "required|email",
                "phone" => "required|min:11|max:15",
                "city_id" => "required",
                "ambulance_type" => "required",
                "address" => "required",
            ]);

            if($validator->fails()){
                return response()->json(["error"=>$validator->errors()]);
            }else{
                $data = Ambulance::find($request->id);
                $old = $data->image;
                if ($request->hasFile('image')) {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                    $data->image = $this->imageUpload($request, 'image', 'uploads/ambulance') ?? '';
                }
                $data->name = $request->name;
                $data->username = $request->username;
                $data->email = $request->email;
                if(!empty($request->password)){
                    $data->password = Hash::make($request->password);
                }
                $data->ambulance_type =implode(",",$request->ambulance_type);
                $data->phone = $request->phone;
                $data->city_id = $request->city_id;
                $data->address = $request->address;
                if(!empty($request->map_link)){
                    $data->map_link = $request->map_link;
                }
                $data->update();
                return response()->json("Ambulance updated successfully");
            }
        }catch(\Throwable $e){
            return response()->json("something went wrong");
        }
    }

    public function destroy(Request $request)
    {
        try{
            $data = Ambulance::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return response()->json("Ambulance Deleted successfully");
        }catch(\Throwable $e){
            return response()->json("something went wrong");
        }
    }
}
