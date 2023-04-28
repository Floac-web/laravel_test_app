<?php

namespace App\Services;

use App\Models\City;
use App\Models\CityWarehouse;
use Illuminate\Support\Facades\Http;

class NovaPoshtaService
{
    public function updateCities($cities)
    {
        foreach ($cities as $city) {
            City::updateOrCreate([
                'name' => $city['Description'],
                'ref' => $city['Ref']
            ]);
        }

        return true;
    }

    public function getCities($page, $perPage)
    {
        $requestPayload = [
            "modelName" => "Address",
            "calledMethod" => "getCities",
            "methodProperties" => [
                "Page" => "$page",
                "Warehouse" => "1",
                "Limit" => $perPage
            ]
        ];

        $response = Http::withBody(json_encode($requestPayload), 'application/json')
        ->get('https://api.novaposhta.ua/v2.0/json/Address/getCities')->json();

        if (!empty($response['errors'])) {
            return false;
        }

        if (empty($response['data'])) {
            return false;
        }

        return $response;
    }

    public function getWareHouses($page, $perPage)
    {
        $requestPayload = [
            "modelName" => "Address",
            "calledMethod" => "getWarehouses",
            "methodProperties" => [
                "Page" => "$page",
                "Limit" => $perPage,
                "Language" => "UA"
            ]
        ];

        $response = Http::withBody(json_encode($requestPayload), 'application/json')
        ->get('https://api.novaposhta.ua/v2.0/json/Address/getWarehouses')->json();

        if (!empty($response['errors'])) {
            return false;
        }

        if (empty($response['data'])) {
            return false;
        }

        return $response;
    }

    public function updateWareHouses($wareHouses)
    {
        foreach ($wareHouses as $wareHouse) {
            CityWarehouse::updateOrCreate([
                'address' => $wareHouse['Description'],
                'city_ref' => $wareHouse['CityRef'],
                'number' => $wareHouse['Number']
            ]);
        }
    }
}
