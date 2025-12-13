<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Bloodtype;
use App\Models\Governrate;
use App\Models\City;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    use ApiResponse; 

    public function bloodTypes()
    {

        $bloodtypes = Bloodtype::all();
        $data = [
            'bloodtypes' => $bloodtypes
        ];

        return $this->apiDataResponse($data);
    }


    public function governrates()
    {

        $governrates = Governrate::all();
        $data = [
            'governrates' => $governrates
        ];

        return $this->apiDataResponse($data);
    }

       public function cities(Request $request)
    {
        $cities = City::where(function($query) use($request){
          if ($request->has('governrate_id')){
            $query->where('governrate_id',$request->governrate_id);
          }
        })->get();
        $data = [
            'cities' => $cities
        ];

        return $this->apiDataResponse($data);
    }
}
