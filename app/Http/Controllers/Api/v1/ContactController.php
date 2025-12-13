<?php

namespace App\Http\Controllers\Api\v1;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ApiResponse;

    public function index()
    {

        $contacts = Contact::all();
        $data = [
            'contacts' => $contacts
        ];

        return $this->apiDataResponse($data);
    }
}