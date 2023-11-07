<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\PurchaseInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PurchaseInvoiceResource;

class PurchaseInvoiceController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(PurchaseInvoiceResource::collection(PurchaseInvoice::latest()->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer',
            'code' => 'required|string|max:10|unique:purchase_invoices',
            'amount' => 'required',
            'delivery_date' => 'required',
            'items' => 'required|array',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $purchaseInvoice = PurchaseInvoice::create([
            'user_id' => Auth::user()->id,
            'company_id' => $request->company_id,
            'code' => $request->code,
            'amount' => $request->amount,
            'delivery_date' => Carbon::parse($request->delivery_date),
        ]);

        if ($request->has('items')) {
            foreach ($request->items as $value) {
                $item = Item::find($value['item_id']);

                if ($item) {
                    InvoiceItem::create([
                        'purchase_invoice_id' => $purchaseInvoice->id,
                        'item_id' => $item->id,
                        'quantity' => $value['quantity'],
                        'amount' => $value['amount'] ?? 0,
                        'expiry_date' => Carbon::parse($value['expiry_date']) ?? null,
                    ]);

                    $item->quantity += $value['quantity'];
                    $item->inStock = true;
                    $item->save();
                }
            }
        }

        return $this->success(new PurchaseInvoiceResource($purchaseInvoice), 'Contract has been fulfilled successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseInvoice $purchaseInvoice)
    {
        return $this->success(new PurchaseInvoiceResource($purchaseInvoice));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseInvoice $purchaseInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseInvoice $purchaseInvoice)
    {
        $purchaseInvoice->delete();
        return $this->success(null, 'Purchase invoice has been deleted successfully!!');
    }
}
