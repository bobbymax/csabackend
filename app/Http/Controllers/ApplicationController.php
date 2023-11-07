<?php

namespace App\Http\Controllers;

use App\Helpers\FilterObjects;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Models\Department;
use App\Models\Group;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
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
        $applications = Application::latest()->get();
        return $this->success(ApplicationResource::collection(FilterObjects::allowedApplications(Auth::user(), $applications)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:4|unique:applications',
            'path' => 'required|string|max:255|unique:applications',
            'icon' => 'required|string',
            'description' => 'required',
            'departments' => 'required|array',
            'groups' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $application = Application::create($request->except('id'));


        if ($request->has('departments') && $request->has('groups')) {
            foreach ($request->departments as $value) {
                $department = Department::find($value);

                if ($department) {
                    $application->departments()->save($department);
                }
            }

            foreach ($request->groups as $value) {
                $group = Group::find($value);

                if ($group) {
                    $application->groups()->save($group);
                }
            }
        }


        return $this->success(new ApplicationResource($application), 'Application created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application): \Illuminate\Http\JsonResponse
    {
        return $this->success(new ApplicationResource($application));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:4',
            'path' => 'required|string|max:255',
            'icon' => 'required|string',
            'departments' => 'required|array',
            'groups' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $application->update($request->except('id'));


        foreach ($request->departments as $value) {
            $department = Department::find($value);

            if ($department && !in_array($department?->id, $application?->departments->pluck('id')->toArray())) {
                $application->departments()->save($department);
            }
        }

        foreach ($request->groups as $value) {
            $group = Group::find($value);

            if ($group && !in_array($group?->id, $application?->groups->pluck('id')->toArray())) {
                $application->groups()->save($group);
            }
        }


        return $this->success(new ApplicationResource($application), 'Application updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application): \Illuminate\Http\JsonResponse
    {
        $application->delete();
        return $this->success(null, 'Application deleted successfully!!');
    }
}
