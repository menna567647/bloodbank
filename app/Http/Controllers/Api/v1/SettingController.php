<?php

namespace App\Http\Controllers\Api\v1;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ApiResponse;

    public function index()
    {

        $settings = Setting::all();
        $data = [
            'settings' => $settings
        ];

        return $this->apiDataResponse($data);
    }
}