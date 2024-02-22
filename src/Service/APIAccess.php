<?php

namespace App\Service;

use App\Controller\APIController;
use PhpParser\Node\Scalar\String_;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class APIAccess
{
    private string $TOKEN = "fbaoICPwwVSWanVBSHQtfRQJCBZIqTscGBlCCpqA";

    public function __construct(private HttpClientInterface $client,) {
    }

    public function fetchDiscogsInformation(): array
    {
        $controller = new APIController();
        $response = $this->client->request(
            'GET',
            'https://api.discogs.com/database/search?q=Nirvana&type=release&token=' . $this->TOKEN,
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content["results"];
    }
}