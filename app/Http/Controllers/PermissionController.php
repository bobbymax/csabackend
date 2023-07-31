<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PermissionController extends Controller
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
        return $this->success(Permission::latest()->get());
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

        $permission = Permission::create([
            'name' => $request->name,
            'label' => Str::slug($request->name)
        ]);

        return $this->success($permission, 'Permission created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission): \Illuminate\Http\JsonResponse
    {
        return $this->success($permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $permission->update([
            'name' => $request->name,
            'label' => Str::slug($request->name)
        ]);

        return $this->success($permission, 'Permission updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): \Illuminate\Http\JsonResponse
    {
        $permission->delete();
        return $this->success(null, 'Permission deleted successfully!!');
    }
}
