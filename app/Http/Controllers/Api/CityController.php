<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::withCount('officeSpace')->get();
        return CityResource::collection($cities);
    }

    public function show(City $city)
    {
        $city->load(['officeSpace.city', 'officeSpace.photos']);
        $city->loadCount('officeSpace');
        return new CityResource($city);
    }
}
