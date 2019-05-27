<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Api extends Controller
{
    private $apikey = "22a005eb0c37f87cdc0cf4bc3e949956";
    private $weatherUrl = "http://api.openweathermap.org/data/2.5/weather";
    private $forecastUrl = "http://api.openweathermap.org/data/2.5/forecast";
    private $lang = 'id';
    private $units = 'metric';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index($name = null)
    {
        return $this->suggestCity($name);
    }

    public function suggestCity($name = null)
    {
        if (!empty($name)) {
            $response = $this->client->request('GET', 'https://script.google.com/macros/s/AKfycbz_fJdc6fbg4vp-0vBS973_CMZbs_xjY9ZSzBgnpV8QujDiLCM/exec',
                [
                    'query' => [
                        'key' => 'ump',
                        'q' => $name,
                    ],
                ]);
            $body = $response->getBody();
            return response($body)->header('Content-Type', 'application/json');
        } else {
            return response()->json(
                [
                    "code" => "Taboo 04",
                    "message" => "cant provide",
                ]
            );
        }
    }

    public function current(Request $request)
    {
        if (!empty($request->input('lat')) && !empty($request->input('lon'))) {
            $response = $this->client->request('GET', $this->weatherUrl,
                [
                    'query' => [
                        'APPID' => $this->apikey,
                        'lang' => $this->lang,
                        'units' => $this->units,
                        'lat' => $request->input('lat'),
                        'lon' => $request->input('lon'),
                    ],
                ]);
            $body = $response->getBody();
            return response($body)->header('Content-Type', 'application/json');
        } else {
            return response()->json(
                [
                    "code" => "Taboo 04",
                    "message" => "cant provide",
                ]
            );
        }
    }

    public function predict(Request $request){
        if (!empty($request->input('lat')) && !empty($request->input('lon'))) {
            $response = $this->client->request('GET', $this->forecastUrl,
                [
                    'query' => [
                        'APPID' => $this->apikey,
                        'lang' => $this->lang,
                        'units' => $this->units,
                        'lat' => $request->input('lat'),
                        'lon' => $request->input('lon'),
                    ],
                ]);
            $body = $response->getBody();
            return response($body)->header('Content-Type', 'application/json');
        } else {
            return response()->json(
                [
                    "code" => "Taboo 04",
                    "message" => "cant provide",
                ]
            );
        }
    }
}
