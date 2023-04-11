<?php

namespace App\Services;

use GuzzleHttp\Client;

class ApiBrasilService
{
    private const URL = "https://brasilapi.com.br";
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::URL,
        ]);
    }

    public function getStates($stateAcronym = null)
    {
        $response = $this->client->get('/api/ibge/uf/v1/' . $stateAcronym)->getBody()->getContents();
        return json_decode($response, true);
    }

    public function getCities($stateAcronym = null) {
        $states = $this->getStates();

        foreach($states as $key => $state) {
            $response = $this->client->get('/api/ibge/municipios/v1/' . $state['sigla'] . '?providers=dados-abertos-br,gov')->getBody()->getContents();

            if($response) {
                $states[$key]['cities'] = json_decode($response, true);
            }
        }

        return $states;
    }
}