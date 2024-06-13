<?php

namespace App\Http\Controllers;

use App\Models\TrackRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrackRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'type' => 'required',
            'description' => 'required',
            'device_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        TrackRecord::create($data);
        return response()->json(["msg"=>"TrackRecord added successfully"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $up = TrackRecord::find($id);
        if($up == null){
            return response()->json(['msg'=>'not found'],404);
        }
        return response()->json(['type'=>$up->type,'description'=>$up->description,'device_id'=>$up->device_id],201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'description' => 'required',
            'device_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        $up = TrackRecord::find($id);
        if($data == null){
            return response()->json(['msg'=>'not found'],404);
        }
        $up->update($data);
        return response()->json(['msg'=>'updated successfully','type'=>$up->type,'description'=>$up->description,'device_id'=>$up->device_id],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = TrackRecord::find($id);
        if($data == null){
            return response()->json(['msg'=>'not found'],404);
        }
        $data->delete();
        return response()->json(['msg'=>'Deleted successfully'],201);
    }
}
