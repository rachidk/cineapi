<?php

namespace App\Service;

use App\Entity\Movie;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientApi
{
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * S'occupe de récuperer le poster depuis l'Api
     * +met à jour l'entité et la persiste en bdd
     *
     */
    public function getPosterFromMovie(Movie $movie)
    {
        $response = $this->client->request(
            'GET',
            'https://1mdb-data-searching.p.rapidapi.com/om',
            [
                'headers' => [
                    'X-RapidAPI-Key' => '57a3a3f7b1mshe9df1b52c98bc95p1c6011jsn1ed2cc2d9d5a',
                    'X-RapidAPI-Host' => '1mdb-data-searching.p.rapidapi.com',
                ],
                'query' => [
                    't' => $movie->getTitle(),
                ],
            ]
        );
        $statusCode = $response->getStatusCode();
        dd($statusCode);
    }
}
