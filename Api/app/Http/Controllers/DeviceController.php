<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $devices = Device::all();
            return response()->json($devices, 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => "someting goes wrong while fetching data", 'error' => $e], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'company_id' => 'required|int',
                'modelNumber' => "required|string",
            ]);
            $device = Device::create($validatedData);
            return response()->json(['msg' => 'device added successfully', 'device' => $device], 200);
        } catch (ValidationException $e) {
            return response()->json(['msg' => 'data should be valid', 'errors' => $e], 422);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'something went wrong while saving the data', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $device = Device::with('company', 'driver', 'records')->findOrFail($id);
            return response()->json(['msg' => 'success', 'data' => $device], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                "modelNumber" => 'required|string',
                "company_id" => "required|int"
            ]);
            $data = Device::findOrFail($id);
            $data->update($validatedData);
            return response()->json(['msg' => 'updated successfully', 'update data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['msg' => 'validation failed', 'error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'someting went wrong', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $device = Device::findOrFail($id);
            $device->delete();
            return response()->json(['msg' => 'device deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
