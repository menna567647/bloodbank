<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\ApiResponse;
use App\Notifications\DonationRequestCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateDonationRequest;
use App\Models\Client;


class DonationController extends Controller
{
    use ApiResponse;

    public function store(CreateDonationRequest $request)
    {
        $clientId = Auth('api')->user()->id;
        $donations = $request->user()->donations()->create($request->validated());
        
        $clientsQuary = Client::whereHas('bloodType', function ($query) use ($donations) {
            $query->where('id', $donations->blood_type_id);
        })
            ->whereHas('city.governrate', function ($query) use ($donations) {
                $query->where('id', $donations->city->governrate_id);
            })->where('id', '!=', $clientId);

        $clientsIds = $clientsQuary->pluck('id')->toArray();

        $notification = $donations->notifications()->create([
            'title' => 'New Donation Request',
            'message' => "new donation request For {$donations->patient_name} has been created",
        ]);


        if (!empty($clientsIds)) {
            $notification->clients()->attach($clientsIds);

            $clients = $clientsQuary->get();

            foreach ($clients as $client) {
                $client->notify(new DonationRequestCreated($notification));
            }
        }


        return $this->apiSuccessMessage('donation request created successfully', [
            'donation_request' => $donations,
        ]);
    }
}