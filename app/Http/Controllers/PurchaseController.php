<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseStoreRequest;
use App\Http\Requests\PurchaseUpdateRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $purchases = Purchase::all();

        return view('purchase.index', compact('purchases'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('purchase.create');
    }

    /**
     * @param \App\Http\Requests\PurchaseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseStoreRequest $request)
    {
        $purchase = Purchase::create($request->validated());

        $request->session()->flash('purchase.id', $purchase->id);

        return redirect()->route('purchase.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Purchase $purchase)
    {
        return view('purchase.show', compact('purchase'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Purchase $purchase)
    {
        return view('purchase.edit', compact('purchase'));
    }

    /**
     * @param \App\Http\Requests\PurchaseUpdateRequest $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseUpdateRequest $request, Purchase $purchase)
    {
        $purchase->update($request->validated());

        $request->session()->flash('purchase.id', $purchase->id);

        return redirect()->route('purchase.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Purchase $purchase)
    {
        $purchase->delete();

        return redirect()->route('purchase.index');
    }
}
