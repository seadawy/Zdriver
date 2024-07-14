<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Company::all();
        if ($data == null) {
            return response()->json(['msg' => 'not found'], 404);
        }
        return response()->json($data, 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        Company::create($data);
        return response()->json(['msg' => 'Company added successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Company::findOrFail($id);
        if ($data == null) {
            return response()->json(['msg' => 'not found'], 404);
        }
        return response()->json(['All data'=>$data], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        $up = Company::findOrFail($id);
        if ($data == null) {
            return response()->json(['msg' => 'not found'], 404);
        }
        $up->update($data);
        return response()->json(['msg' => 'updated successfully', 'name' => $up->name, 'phone' => $up->phone, 'address' => $up->address], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Company::findOrFail($id);
        if ($data == null) {
            return response()->json(['msg' => 'not found'], 404);
        }
        $data->delete();
        return response()->json(['msg' => 'Deleted successfully'], 201);
    }
}
