<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Models\City;
use App\Models\Governrate;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read cities')->only(['index']);
        $this->middleware('can:create cities')->only(['create', 'store']);
        $this->middleware('can:update cities')->only(['edit', 'update']);
        $this->middleware('can:delete cities')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::paginate(10);
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $governrats = Governrate::all();
        return view('admin.cities.create', compact('governrats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        City::create($request->validated());

        return redirect()->route('admin.cities.index')->with("message", __("messages.CREATEDSUCCESSFULLY"));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $City = City::findOrFail($id);
        $City->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
