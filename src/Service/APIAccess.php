<?php

namespace App\Service;

use App\Controller\APIController;
use PhpParser\Node\Scalar\String_;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class APIAccess
{
    private string $TOKEN = "fbaoICPwwVSWanVBSHQtfRQJCBZIqTscGBlCCpqA";

    public function __construct(private readonly HttpClientInterface $client,) {
    }

    public function fetchDiscogsInformation(): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.discogs.com/database/search?q=' . $_GET['q'] . '&type=release&token=' . $this->TOKEN,
        );

        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content["results"];
    }
}