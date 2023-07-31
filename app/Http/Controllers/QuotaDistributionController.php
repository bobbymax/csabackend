<?php

namespace App\Http\Controllers;

use App\Models\QuotaDistribution;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuotaDistributionController extends Controller
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
        return $this->success(QuotaDistribution::where('user_id', Auth::user()->id)->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'quota_id' => 'required|integer',
            'requisition_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $quotaDistribution = QuotaDistribution::create($request->all());
        return $this->success($quotaDistribution, 'Distribution saved successfully!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotaDistribution $quotaDistribution): \Illuminate\Http\JsonResponse
    {
        return $this->success($quotaDistribution);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotaDistribution $quotaDistribution): \Illuminate\Http\JsonResponse
    {
        $quotaDistribution->delete();
        return $this->success(null, 'Distribution deleted successfully!!');
    }
}
