<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    use HttpResponses;
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('login');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->success(Company::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'acronym' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'type' => 'required|string|max:10|in:owner,support,vendor,jv,other'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $company = Company::create([
            'name' => $request->name,
            'acronym' => $request->acronym,
            'rc_no' => $request->rc_no,
            'tin_no' => $request->tin_no,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'payment_code' => $request->payment_code,
            'type' => $request->type,
        ]);

        return $this->success($company, 'Company details created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): \Illuminate\Http\JsonResponse
    {
        return $this->success($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'acronym' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'type' => 'required|string|max:10|in:owner,support,vendor,jv,other'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $company->update([
            'name' => $request->name,
            'acronym' => $request->acronym,
            'rc_no' => $request->rc_no,
            'tin_no' => $request->tin_no,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'payment_code' => $request->payment_code,
            'type' => $request->type,
        ]);

        return $this->success($company, 'Company details have been updated sucessfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): \Illuminate\Http\JsonResponse
    {
        $company->delete();
        return $this->success(null, 'Company deleted successfully!!');
    }
}
