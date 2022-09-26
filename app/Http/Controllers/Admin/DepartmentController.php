<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view("admin.department.index");
    }

    public function getData()
    {
        $data = Department::latest()->get();
        return response()->json(["data"=>$data]);
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                "name" => "required"
            ],["name.required" => "Department name required"]);
            if($validator->fails()){
                return response()->json(["error" => $validator->errors()]);
            }else{
                Department::create($request->all());
                return response()->json("Department added successfully");
            }
        }catch(\Throwable $e){
            return response()->json("Something went wrong");
        }
    }
    public function edit(Request $request)
    {
        try{
            $data = DB::table("departments")->where("id", $request->id)->first();
            return response()->json($data);
        }catch(\Throwable $e){
            return response()->json("something went wrong");
        }
    }

    public function update(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                "name" => "required"
            ],["name.required" => "Department name required"]);
            if($validator->fails()){
                return response()->json(["error"=>$validator->errors()]);
            }else{
                $data = Department::find($request->id);
                $data->name = $request->name;
                $data->updated_at = Carbon::now();
                $data->update();
                return response()->json("Department updated successfully");
            }
        }catch(\Throwable $e){
            return response()->json("something went wrong");
        }
    }

    public function destroy(Request $request)
    {
        try{
            Department::find($request->id)->delete();
            return response()->json("Department delete successfully");
        }catch(\Throwable $e){
            return response()->json("something went wrong");
        }
    }
}
