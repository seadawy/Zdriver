<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        if ($data == null) {
            return response()->json(['msg' => 'not found'], 404);
        }
        return response()->json($data, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'role' => 'required',
            'gender' => 'required|bool',
            'phone' => 'required',
            'email' => 'required|email',
            'company_id' => 'required|int',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        User::create($data);
        return response()->json(['msg' => 'User added successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = User::findOrFail($id);
        if ($data == null) {
            return response()->json(['msg' => 'not found'], 404);
        }
        return response()->json($data, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'role' => 'required',
            'gender' => 'required|bool',
            'phone' => 'required',
            'email' => 'required|email',
            'company_id' => 'required|int',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        if (User::findOrFail($id)->update($data)) {
            return response()->json(['msg' => 'updated successfully', 'update data' => $data], 201);
        } else {
            return response()->json(['msg' => 'someting went wrong'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        if ($data == null) {
            return response()->json(['msg' => 'not found'], 404);
        }
        $data->delete();
        return response()->json(['msg' => 'Deleted successfully','name'=>$data->name], 201);
    }
}
