<?php

namespace App\Controller;

use App\Service\APIAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class APIController extends AbstractController
{
    #[Route(path: '/api', name: 'api_content')]
    public function apiContent(APIAccess $apiAccess): Response
    {
        return $this->render('api/api.html.twig', [
            'albumList' => $apiAccess->fetchDiscogsInformation(),
        ]);
    }
}