<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GovernrateRequest;
use App\Models\Governrate;

class GovernrateController extends Controller
{
        public function __construct()
    {
        $this->middleware('can:read governorates')->only(['index']);
        $this->middleware('can:create governorates')->only(['create', 'store']);
        $this->middleware('can:update governorates')->only(['edit', 'update']);
        $this->middleware('can:delete governorates')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $governrats = Governrate::withCount('cities')->paginate(10);
        return view('admin.governrates.index', compact('governrats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.governrates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GovernrateRequest $request)
    {
        Governrate::create($request->validated());

        return redirect()->route('admin.governorates.index')->with("message", __("messages.CREATEDSUCCESSFULLY"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $governrate = Governrate::findOrFail($id);
        $governrate->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}