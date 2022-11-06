<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class HospitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $hospital = DB::table("hospitals")->orderBy("id", 'DESC')->get();
        return view("admin.hospital.index", compact("hospital"));
    }

    public function create()
    {
        return view("admin.hospital.create");
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "username" => "required|unique:hospitals",
                "email" => "required|email",
                "password" => "required",
                "phone" => "required|min:11|max:15",
                "city_id" => "required",
                "discount_amount" => "required",
                "hospital_type" => "required",
                "address" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            } else {
                $data = new Hospital;
                $data->image = $this->imageUpload($request, 'image', 'uploads/hospital') ?? '';
                $data->name = $request->name;
                $data->username = $request->username;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->hospital_type = $request->hospital_type;
                $data->phone = $request->phone;
                $data->discount_amount = $request->discount_amount;
                $data->city_id = $request->city_id;
                $data->address = $request->address;
                $data->map_link = $request->map_link;
                $data->save();
                return response()->json("Hospital added successfully");
            }
        } catch (\Throwable $e) {
            return response()->json("something went wrong");
        }
    }

    public function edit($id)
    {
        $data = Hospital::find($id);
        return view("admin.hospital.edit", compact('data'));
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "username" => "required|unique:hospitals,username," . $request->id,
                "email" => "required|email",
                "phone" => "required|min:11|max:15",
                "city_id" => "required",
                "discount_amount" => "required",
                "hospital_type" => "required",
                "address" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            } else {
                $data = Hospital::find($request->id);
                $old = $data->image;
                if ($request->hasFile('image')) {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                    $data->image = $this->imageUpload($request, 'image', 'uploads/hospital') ?? '';
                }
                $data->name = $request->name;
                $data->username = $request->username;
                $data->email = $request->email;
                if (!empty($request->password)) {
                    $data->password = Hash::make($request->password);
                }
                $data->hospital_type = $request->hospital_type;
                $data->phone = $request->phone;
                $data->discount_amount = $request->discount_amount;
                $data->city_id = $request->city_id;
                $data->address = $request->address;
                $data->map_link = $request->map_link;

                $data->update();
                return response()->json("Hospital updated successfully");
            }
        } catch (\Throwable $e) {
            return response()->json("something went wrong");
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Hospital::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return response()->json("Hospital Deleted successfully");
        } catch (\Throwable $e) {
            return response()->json("something went wrong");
        }
    }
}
