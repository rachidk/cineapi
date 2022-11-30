<?php

namespace App\Service;

use App\Entity\Movie;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientApi
{
    public const HTTP_STATUS_OK = 200;

    private $manager;

    public function __construct(HttpClientInterface $client, ManagerRegistry $manager)
    {
        $this->manager = $manager;
    }

    /**
     * S'occupe de récuperer le poster depuis l'Api
     * +met à jour l'entité et la persiste en bdd
     *
     */
    public function getPosterFromMovie(Movie $movie): ?string
    {
        try {
            $response = $this->client->request(
                'GET',
                'https://movie-database-alternative.p.rapidapi.com/',
                [
                    'headers' => [
                        'X-RapidAPI-Key' => '167f3c2aacmsh2c3a33f9a3c17fap1d983ajsnf53bdbaa3ffe',
                        'X-RapidAPI-Host' => 'movie-database-alternative.p.rapidapi.com',
                    ],
                    'query' => [
                        't' => $movie->getTitle(),
                    ],
                ]
            );
            if ($response->getStatusCode() == self::HTTP_STATUS_OK) {
                $content = json_decode($response->getContent());

                if ($content->Response == 'False') {
                    return null;
                }

                $movie->setPoster($content->Poster);
                $this->updatePosterMovie($movie);
            }

            return $content->Poster;
        } catch (Exception $ex) {
            return null;
        }
    }

    private function updatePosterMovie(Movie $movie)
    {
        $manager = $this->manager->getManager();
        $manager->persist($movie);
        $manager->flush();
    }
}
