<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BloodtypeRequest;
use App\Models\Bloodtype;

class BloodtypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:read bloodtypes')->only(['index']);
        $this->middleware('can:create bloodtypes')->only(['create', 'store']);
        $this->middleware('can:update bloodtypes')->only(['edit', 'update']);
        $this->middleware('can:delete bloodtypes')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Bloodtypes = Bloodtype::withCount('clients')->paginate(10);
        return view('admin.bloodtypes.index', compact('Bloodtypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bloodtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BloodtypeRequest $request)
    {
        Bloodtype::create($request->validated());

        return redirect()->route('admin.bloodtypes.index')->with("message", __("messages.CREATEDSUCCESSFULLY"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Bloodtype = Bloodtype::findOrFail($id);
        $Bloodtype->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}