<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class GeolocationController extends Controller
{
    public function getCountry(Request $request)
    {
        $url = 'https://countriesnow.space/api/v0.1/countries/iso';
        $response = Http::get($url);
        $responseData = json_decode($response->getBody(), true);

        if ($response->successful() && isset($responseData['data'])) {
            $countries = collect($responseData['data']);
            if ($request->input('q', '') != '') {
                $countries = $countries->filter(function ($country) use ($request) {
                    return stripos($country['name'], $request->q) !== false;
                });
            }
            $result = $countries->map(function ($country) {
                return [
                    'id' => $country['Iso2'],
                    'text' => $country['name'],
                ];
            })->values();

            return response()->json($result, $response->status());
        } else {
            return response()->json(['error' => 'Unable to fetch data from API'], $response->status());
        }
    }

    public function getCity(Request $request)
    {
        $client = new Client();

        $body = json_encode(['iso2' => $request->country]);

        $apiRequest = new GuzzleRequest('POST', 'https://countriesnow.space/api/v0.1/countries/states', [
            'Content-Type' => 'application/json'
        ], $body);

        $response = $client->sendAsync($apiRequest)->wait();
        $responseData = json_decode($response->getBody(), true);
        if ($response->getStatusCode() == 200 && isset($responseData['data']['states'])) {
            $states = collect($responseData['data']['states']);
            if ($request->input('q', '') != '') {
                $states = $states->filter(function ($state) use ($request) {
                    return stripos($state['name'], $request->q) !== false;
                });
            }
            $result = $states->map(function ($state) {
                return [
                    'id' => $state['state_code'],
                    'text' => $state['name'],
                ];
            })->values();

            return response()->json($result, $response->getStatusCode());
        } else {
            return response()->json(['error' => 'Unable to fetch data from API'], $response->getStatusCode());
        }
    }
}
