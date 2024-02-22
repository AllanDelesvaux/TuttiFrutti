<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class APIAccess
{
    private string $TOKEN = "fbaoICPwwVSWanVBSHQtfRQJCBZIqTscGBlCCpqA";

    public function __construct(private readonly HttpClientInterface $client,) {
    }

    public function fetchDiscogsInformation(): array
    {
        if(isset($_GET['q'])){
            $externalURL = 'https://api.discogs.com/database/search?q=' . $_GET['q'] . '&type=release&token=' . $this->TOKEN;
        }
        else {
            $externalURL = 'https://api.discogs.com/database/search?type=release&token=' . $this->TOKEN;
        }

        $response = $this->client->request(
            'GET',
            $externalURL,
        );

        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content["results"];
    }
}