<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
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
        return $this->success(User::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'grade_level_id' => 'required|integer',
            'department_id' => 'required|integer',
            'staff_type_id' => 'required|integer',
            'availability_id' => 'required|integer',
            'location_id' => 'required|integer',
            'company_id' => 'required|integer',
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'staff_no' => 'required|string|max:255|unique:users',
            'email' => 'required|string|max:255|email|unique:users'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $staff = User::create([...$request->all(), 'password' => Hash::make('password')]);
        return $this->success($staff, 'User Record has been created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): \Illuminate\Http\JsonResponse
    {
        return $this->success($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'grade_level_id' => 'required|integer',
            'department_id' => 'required|integer',
            'staff_type_id' => 'required|integer',
            'availability_id' => 'required|integer',
            'location_id' => 'required|integer',
            'company_id' => 'required|integer',
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'staff_no' => 'required|string|max:255',
            'email' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $user->update($request->all());
        return $this->success($user, 'User Record has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        $user->delete();
        return $this->success(null, 'Staff record deleted successfully!!');
    }
}
