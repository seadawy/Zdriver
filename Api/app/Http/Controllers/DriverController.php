<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Driver::with('user', 'device')->get();
        if ($data == null) {
            return response()->json(['msg' => 'not found'], 404);
        }
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|int', 'device_id' => 'required|int', 'score' => 'required|int'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        try {
            $driver = Driver::create($data);
            return response()->json(['msg' => 'Driver added successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Driver could not be added', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = Driver::with('user', 'device')->where('id', $id);
        } catch (\Exception $e) {

            return response()->json($data, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|int', 'device_id' => 'required|int', 'score' => 'required|int'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        try{
            Driver::findOrFail($id)->update($data);
            return response()->json(['msg' => 'updated successfully', 'update data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'someting went wrong'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Driver::findOrFail($id);
        if ($data == null) {
            return response()->json(['msg' => 'not found'], 404);
        }
        $data->delete();
        return response()->json(['msg' => 'Deleted successfully', 'Driver_id' => $data->id], 201);
    }
}
