<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Http\Requests\Api\CreateDonationRequest;
use App\Models\Bloodtype;
use App\Models\City;
use App\Models\Client;

class ClientDonationController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client_id = Auth('client')->user()->id;
        $donations = Donation::where('client_id', $client_id)->get();
        return view('website.donations.index', compact('donations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function create()
    {
        $bloodTypes = Bloodtype::all();
        $cities = City::all();
        return view('website.donations.create', compact('bloodTypes', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(CreateDonationRequest $request)
    {
        $client = auth('client')->user();
        $validated = $request->validated();
        $validated['client_id'] = $client->id;

        $donation = Donation::create($validated);

        $clients = Client::whereHas('bloodType', function ($query) use ($donation) {
            $query->where('id', $donation->blood_type_id);
        })->whereHas('city', function ($query) use ($donation) {
            $query->where('id', $donation->city_id);
        });
        $clients_ids = $clients->pluck('id')->toArray();

        $notification = $donation->notifications()
        ->create([
                'title' => 'new donation request',
                'message' => "for {$donation->patient_name} has been created"
            ]);

            if (!empty($clients_ids)) {
                $notification->clients()->attach($clients_ids);
            }

        return redirect()->route('website.donations.index')->with("message",  __("messages.donation_request_succcess"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $donation = Donation::findOrFail($id);
        return view('website.donations.edit', compact('donation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateDonationRequest $request, string $id)
    {
        $donation = Donation::findOrFail($id);
        $validated = $request->validated();
        $donation->update($validated);

        $donation->notifications()
            ->update([
                'title' => 'An update for a donation request',
                'message' => "By {$request->patient_name}"
            ]);

        return redirect()->route('website.donations.index')->with("message",  __("messages.donation_request_edit_succcess"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Donation = Donation::findOrFail($id);
        $status = $Donation->status;
        if ($status == 'pending') {
            $notifications = $Donation->notifications()->get();
            foreach ($notifications as $notification) {
                $notification->clients()->detach();
            }
            $Donation->notifications()->delete();
            $Donation->delete();
        } else {
            return redirect()->route('website.donations.index')->with("message",  __("messages.donation_delete"));
        }
        return redirect()->route('website.donations.index')->with("message",  __("messages.deleted_successfully"));
    }
}
