<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Http\Requests\Website\ReportRequest;
use App\Models\Donation;

class ReportController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Auth('client')->user();
        $reports = $client->reports()->get();
        $reports_count = $reports->count();
        return view('website.reports.index', compact('reports', 'reports_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $donation = Donation::findOrFail($id);
        return view('website.reports.create', compact('donation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportRequest $request)
    {
        $client_id=Auth('client')->user()->id;
        $validated = $request->validated();
        $validated['client_id']=$client_id;
        Report::create($validated);
        return redirect()->route('website.reports.index')->with('message', 'report sent successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return redirect()->route('website.reports.index')->with('message', 'report deleted successfully');
    }
}
