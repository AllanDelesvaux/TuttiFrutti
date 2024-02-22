<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class APIAccess
{
    private string $TOKEN = "fbaoICPwwVSWanVBSHQtfRQJCBZIqTscGBlCCpqA";

    public function __construct(private readonly HttpClientInterface $client,) {
    }

    public function fetchDiscogsInformation(string $userResearch): array
    {
        $externalURL = 'https://api.discogs.com/database/search?q=' . $userResearch . '&type=release&token=' . $this->TOKEN . '&per_page=' . 10;

        $response = $this->client->request(
            'GET',
            $externalURL,
        );

        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content["results"];
    }

    public function fetchDiscogsWithId(int $id): array
    {
        $externalURL = 'https://api.discogs.com/releases/'.$id.'?token='. $this->TOKEN;

        $response = $this->client->request(
            'GET',
            $externalURL,
        );

        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }


}