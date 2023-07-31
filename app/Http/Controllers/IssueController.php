<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IssueController extends Controller
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
        return $this->success(Issue::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'incident_category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'parentId' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $issue = Issue::create([...$request->all(), 'label' => Str::slug($request->name)]);
        return $this->success($issue, 'Issue created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Issue $issue): \Illuminate\Http\JsonResponse
    {
        return $this->success($issue);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Issue $issue): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'incident_category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'parentId' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $issue->update([...$request->all(), 'label' => Str::slug($request->name)]);
        return $this->success($issue, 'Issue updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue): \Illuminate\Http\JsonResponse
    {
        $issue->delete();
        return $this->success($issue, 'Issue deleted successfully!!');
    }
}
