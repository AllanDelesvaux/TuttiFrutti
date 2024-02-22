<?php

namespace App\Controller;

use App\Service\APIAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class APIController extends AbstractController
{
    public string $title;
    public string $fruit;
    public string $year;
    public string $coverImage;
    #[Route(path: '/api', name: 'api_content')]
    public function apiContent(APIAccess $apiAccess): Response
    {

        $this->title = $apiAccess->fetchDiscogsInformation()[0]["title"];
        $this->fruit = $apiAccess->fetchDiscogsInformation()[0]["type"];
        $this->year = $apiAccess->fetchDiscogsInformation()[0]["year"];
        $this->coverImage = $apiAccess->fetchDiscogsInformation()[0]["cover_image"];

        return $this->render('api/api.html.twig', [
            'title' => $this->title,
            'fruit' => $this->fruit,
            'year' => $this->year,
            'coverImage' => $this->coverImage,
        ]);
    }
}