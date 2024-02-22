<?php

namespace App\Controller;

use App\Service\APIAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class APIController extends AbstractController
{
    public array $searchInformation;
    #[Route(path: '/searchingPage/{fruit}', name: 'fruit_content')]
    public function apiContent(APIAccess $apiAccess, string $fruit): Response
    {
        $this->searchInformation = $apiAccess->fetchDiscogsInformation($fruit);

        return $this->render('api/api.html.twig', [
            'albumList' => $this->searchInformation,
            'userResearch' => $fruit,
            'searchSize' => sizeof($this->searchInformation),
        ]);
    }
}