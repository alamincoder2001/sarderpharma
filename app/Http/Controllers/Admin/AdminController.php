<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Test;
use App\Models\Donor;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Ambulance;
use App\Models\Diagnostic;
use Illuminate\Http\Request;
use App\Models\Investigation;
use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data['doctor'] = Doctor::all();
        $data['hospital'] = Hospital::all();
        $data['diagnostic'] = Diagnostic::all();
        $data['ambulance'] = Ambulance::all();
        return view("admin.dashboard", compact("data"));
    }

    public function profile()
    {
        return view("admin.profile.index");
    }

    public function getProfile()
    {
        $admin = Auth::guard("admin")->user();
        return response()->json($admin);
    }

    public function saveProfile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|email"
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            } else {
                if ($request->hasFile('image')) {
                    $admin = Auth::guard("admin")->user();
                    $old = $admin->image;
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                    $admin->image = $this->imageUpload($request, 'image', 'uploads/admin') ?? '';

                    $admin->name = $request->name;
                    $admin->email = $request->email;
                    $admin->updated_at = Carbon::now();
                    $admin->update();
                    return response()->json("Admin Profile updated successfully");
                } else {
                    $admin = Auth::guard("admin")->user();
                    $admin->name = $request->name;
                    $admin->email = $request->email;
                    $admin->updated_at = Carbon::now();
                    $admin->update();
                    return response()->json("Admin Profile updated successfully");
                }
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }

    // Password Controller 

    public function password()
    {
        return view("admin.profile.password");
    }

    public function passwordChange(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "password" => "required",
                "new_password" => "required",
                "confirm_password" => "required|same:new_password"
            ], [
                "new_password.required" => "New password required",
                "confirm_password.required" => "Confirm password required"
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            } else {
                $admin = Auth::guard("admin")->user();
                $hash_password = $admin->password;
                if (Hash::check($request->password, $hash_password)) {
                    $admin->password = Hash::make($request->new_password);
                    $admin->update();
                    return response()->json("Password Change Successfully");
                } else {
                    return response()->json(["errors" => "Current password does not match"]);
                }
            }
        } catch (\Throwable $e) {
            return response()->json("something went wrong");
        }
    }

    // blood donor
    public function blooddonor()
    {
        $data = Donor::latest()->get();
        return view("admin.donor.index", compact("data"));
    }

    public function donordestroy(Request $request)
    {
        try {
            $data = Donor::find($request->id);
            $old = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return response()->json("Donor delete successfully");
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }

    public function showprescription()
    {
        $data = Prescription::latest()->get();
        return view("admin.prescription.index", compact("data"));
    }
}
