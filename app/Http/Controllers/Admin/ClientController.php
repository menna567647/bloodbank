<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\Client;
use App\Models\City;
use App\Models\Bloodtype;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read clients')->only(['index']);
        $this->middleware('can:create clients')->only(['create', 'store']);
        $this->middleware('can:update clients')->only(['edit', 'update']);
        $this->middleware('can:delete clients')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::with(['bloodType', 'city'])
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->filled('city_id'), function ($query) use ($request) {
                $query->where('city_id', $request->city_id);
            })
            ->when($request->filled('blood_type_id'), function ($query) use ($request) {
                $query->where('blood_type_id', $request->blood_type_id);
            })
            ->paginate(10)
            ->appends($request->query());

        $cities = City::all();
        $bloodTypes = BloodType::all();
        $totalClients = $clients->total();

        return view('admin.clients.index', compact(
            'clients',
            'cities',
            'bloodTypes',
            'totalClients'
        ));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, string $id)
    {
        $client = Client::findOrFail($id);
        $validated = $request->validated();
        $client->update($validated);
        return redirect()->route('admin.clients.index')->with("message",  __("messages.UPDATEDSUCCESSFULLY"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Client = Client::findOrFail($id);
        $Client->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
