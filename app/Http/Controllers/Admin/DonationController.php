<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Http\Requests\Admin\DonationRequest;


class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read donations')->only(['index']);
        $this->middleware('can:create donations')->only(['create', 'store']);
        $this->middleware('can:update donations')->only(['edit', 'update']);
        $this->middleware('can:delete donations')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::with('bloodType', 'city')->paginate(10);
        foreach ($donations as $donation) {
            $updated_at = $donation->updated_at;
        };
        return view('admin.donations.index', compact('donations'));
    }

    /**
     * Display details of the donation.
     */
    public function details(string $id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.donations.detail', compact('donation'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.donations.edit', compact('donation'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DonationRequest $request, string $id)
    {
        $donation = Donation::findOrFail($id);
        $validated = $request->validated();
        $is_spam = $request->is_spam;
        if ($is_spam == 1) {
            $donation->notifications()->each(function ($notification) {
                $notification->clients()->detach();
            });
            $donation->notifications()->delete();
        }
        $donation->update($validated);
        return redirect()->route('admin.donationDetails', $id)->with("message",  __("messages.donation_request_edit_succcess"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Donation = Donation::findOrFail($id);
        if ($Donation->is_spam == "1") {
            $Donation->notifications()->delete();
            $Donation->delete();
        } else if ($Donation->is_spam == "0") {
            if ($Donation->status == "expired") {
                
                $notifications = $Donation->notifications()->get();
                foreach ($notifications as $notification) {
                    $notification->clients()->detach();
                };
                $Donation->notifications()->delete();
                $Donation->delete();
                return response()->json(['message' => 'Deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'not deleted'], 400);
            }
        }
    }
}
