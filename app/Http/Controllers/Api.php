<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class Api extends Controller
{
    public function __construct()
    {
        $this->client = new Client();
    }

    public function index($name = null)
    {
        return $this->suggestCity($name);
    }

    public function suggestCity($name = null){
        if (!empty($name)) {
            $response = $this->client->request("GET", "https://kagarin.id/api/private/weatheria/?key=ump&kota={$name}");
            $body = $response->getBody();
            return response($body)->header('Content-Type', 'application/json');
        }else{
            return response()->json(
                [
                    "code" => "Taboo 04",
                    "message" => "cant provide",
                ]
            );
        }
    }
}

