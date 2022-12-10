<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestorStoreRequest;
use App\Http\Requests\InvestorUpdateRequest;
use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $investors = Investor::all();

        return view('investor.index', compact('investors'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('investor.create');
    }

    /**
     * @param \App\Http\Requests\InvestorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvestorStoreRequest $request)
    {
        $investor = Investor::create($request->validated());

        $request->session()->flash('investor.id', $investor->id);

        return redirect()->route('investor.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Investor $investor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Investor $investor)
    {
        return view('investor.show', compact('investor'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Investor $investor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Investor $investor)
    {
        return view('investor.edit', compact('investor'));
    }

    /**
     * @param \App\Http\Requests\InvestorUpdateRequest $request
     * @param \App\Models\Investor $investor
     * @return \Illuminate\Http\Response
     */
    public function update(InvestorUpdateRequest $request, Investor $investor)
    {
        $investor->update($request->validated());

        $request->session()->flash('investor.id', $investor->id);

        return redirect()->route('investor.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Investor $investor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Investor $investor)
    {
        $investor->delete();

        return redirect()->route('investor.index');
    }
}
