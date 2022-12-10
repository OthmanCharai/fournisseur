<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestmentStoreRequest;
use App\Http\Requests\InvestmentUpdateRequest;
use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $investments = Investment::all();

        return view('investment.index', compact('investments'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('investment.create');
    }

    /**
     * @param \App\Http\Requests\InvestmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvestmentStoreRequest $request)
    {
        $investment = Investment::create($request->validated());

        $request->session()->flash('investment.id', $investment->id);

        return redirect()->route('investment.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Investment $investment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Investment $investment)
    {
        return view('investment.show', compact('investment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Investment $investment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Investment $investment)
    {
        return view('investment.edit', compact('investment'));
    }

    /**
     * @param \App\Http\Requests\InvestmentUpdateRequest $request
     * @param \App\Models\Investment $investment
     * @return \Illuminate\Http\Response
     */
    public function update(InvestmentUpdateRequest $request, Investment $investment)
    {
        $investment->update($request->validated());

        $request->session()->flash('investment.id', $investment->id);

        return redirect()->route('investment.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Investment $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Investment $investment)
    {
        $investment->delete();

        return redirect()->route('investment.index');
    }
}
