<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GroupController extends Controller
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
        return $this->success(Group::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $group = Group::create([...$request->except('id'), 'label' => Str::slug($request->name)]);

        return $this->success($group, 'Group created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group): \Illuminate\Http\JsonResponse
    {
        return $this->success($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $group->update([
            'name' => $request->name,
            'label' => Str::slug($request->name)
        ]);

        return $this->success($group, 'Group updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group): \Illuminate\Http\JsonResponse
    {
        $group->delete();
        return $this->success(null, 'Group deleted successfully!!');
    }
}
