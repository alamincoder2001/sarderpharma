<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Ambulance;
use App\Models\Diagnostic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\District;

class FilterController extends Controller
{
    // appoinment page filltering
    public function cityappointment(Request $request)
    {
        try {
            $data = Upazila::where("district_id", $request->id)->orderBy('name')->get();
            if (!empty($data)) {
                return response()->json($data);
            } else {
                return response()->json(["null" => "Not Found Data"]);
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }

    public function City(Request $request)
    {
        try {
            if ($request->doctor || $request->service == "Doctor") {
                $data = Doctor::with("department")->where("city_id", $request->id)->orderBy('name')->get();
            } elseif ($request->hospital || $request->service == "Hospital") {
                $data = Hospital::with("city")->where("city_id", $request->id)->orderBy('name')->get();
            } elseif ($request->diagnostic || $request->service == "Diagnostic") {
                $data = Diagnostic::with("city")->where("city_id", $request->id)->orderBy('name')->get();
            } else {
                $data = Ambulance::with("city")->where("city_id", $request->id)->orderBy('name')->get();
            }
            if (isset($data) !== 0) {
                return response()->json($data);
            } else {
                return response()->json(["null" => "Not Found Data"]);
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }

    public function doctor(Request $request)
    {
        try {
            if (!empty($request->doctor_name) && !empty($request->city)) {
                $data = Doctor::with("city", "department", "hospital", "diagnostic")->where('city_id', $request->city)->orWhere('name', "like" . "%" . $request->doctor_name . "%")->orderBy('name')->get();
            } else if (!empty($request->doctor_name)) {
                $data = Doctor::with("city", "department", "hospital", "diagnostic")->where('name', 'like', '%' . $request->doctor_name . '%')->orderBy('name')->get();
            } else {
                $data = Doctor::with("city", "department", "hospital", "diagnostic")->where("city_id", $request->city)->orderBy('name')->get();
            }
            if (count($data) !== 0) {
                return response()->json($data);
            } else {
                return response()->json(["null" => "Not Found Data"]);
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }

    // doctor single change
    public function doctorsinglechange(Request $request)
    {
        try {
            $data = Doctor::with("city", "department", "hospital", "diagnostic")->where("id", $request->id)->orderBy('name')->get();
            if (!empty($data)) {
                return response()->json($data);
            } else {
                return response()->json(["null" => "Not Found Data"]);
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }

    public function diagnostic(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "city" => "required",
            ]);
            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            } else {
                $dataArry = ["city_id" => $request->city, "name" => $request->diagnostic_name];
                if (!empty($request->diagnostic_name)) {
                    $data = Diagnostic::with("city")->where($dataArry)->orderBy('name')->get();
                } else {
                    $data = Diagnostic::with("city")->where("city_id", $request->city)->orderBy('name')->get();
                }
                if (count($data) !== 0) {
                    return response()->json($data);
                } else {
                    return response()->json(["null" => "Not Found Data"]);
                }
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }

    public function ambulance(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "city" => "required",
            ]);
            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            } else {
                $dataArry = ["city_id" => $request->city, "name" => $request->ambulance_name];
                if (!empty($request->ambulance_name)) {
                    $data = Ambulance::with("city")->where($dataArry)->orderBy('name')->get();
                } else {
                    $data = Ambulance::with("city")->where("city_id", $request->city)->orderBy('name')->get();
                }
                if (count($data) !== 0) {
                    return response()->json($data);
                } else {
                    return response()->json(["null" => "Not Found Data"]);
                }
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }
    public function hospital(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "city" => "required",
            ]);
            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            } else {
                $dataArry = ["city_id" => $request->city, "name" => $request->hospital_name];
                if (!empty($request->hospital_name)) {
                    $data = Hospital::with("city")->where($dataArry)->orderBy('name')->orderBy('name')->get();
                } else {
                    $data = Hospital::with("city")->where("city_id", $request->city)->orderBy('name')->get();
                }
                if (count($data) !== 0) {
                    return response()->json($data);
                } else {
                    return response()->json(["null" => "Not Found Data"]);
                }
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }
    public function hospitaldiagnosticdoctor(Request $request)
    {
        try {
            $dataArry = [$request->name => $request->id, "department_id" => $request->department];
            if ($request->name == "hospital_id") {
                if (empty($request->department)) {
                    $data = Doctor::where("hospital_id", $request->id)->orderBy('name')->get();
                } else {
                    $data = Doctor::where($dataArry)->orderBy('name')->get();
                }
            } else {
                if (empty($request->department)) {
                    $data = Doctor::where("diagnostic_id", $request->id)->orderBy('name')->get();
                } else {
                    $data = Doctor::where($dataArry)->orderBy('name')->get();
                }
            }
            if (count($data) !== 0) {
                return response()->json($data);
            } else {
                return response()->json(["null" => "Not Found Data"]);
            }
        } catch (\Throwable $e) {
            return response()->json("Something went wrong");
        }
    }

    public function cityall()
    {
        $data = District::all();
        return response()->json($data);
    }
}
