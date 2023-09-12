<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->success(Room::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'hall_category_id' => 'required|integer',
            'wing_id' => 'required|integer',
            'floor_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'max_sitting_capacity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $room = Room::create($request->except('id'));
        return $this->success($room, 'Room has been created successfully!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room): \Illuminate\Http\JsonResponse
    {
        return $this->success($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'hall_category_id' => 'required|integer',
            'wing_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'max_sitting_capacity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $room->update($request->all());
        return $this->success($room, 'Room has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room): \Illuminate\Http\JsonResponse
    {
        $room->delete();
        return $this->success(null, 'Room has been deleted successfully!');
    }
}
