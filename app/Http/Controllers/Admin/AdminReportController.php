<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;


class AdminReportController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports=Report::latest()->paginate('10');
        return view('admin.reports.index', compact('reports'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return redirect()->route('admin.reports.index')->with('message', 'report deleted successfully');
    }
}
