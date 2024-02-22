<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class APISearchController extends AbstractController
{
    public string $userResearch = "";
    #[Route(path: '/searchingPage', name: 'search_in_api')]
    public function apiContent(): Response
    {
        if(isset($_GET['q'])){
            $this->userResearch = $_GET['q'];

            //Si la barre de recherche est vide on reste sur la même page...
            if($this->userResearch == ""){
                return $this->redirectToRoute('search_in_api',
                    [],
                    Response::HTTP_SEE_OTHER);
            }

            //... sinon on renvoie la page de la recherche associée
            return $this->redirectToRoute('fruit_content',
                ['fruit' => $this->userResearch],
                Response::HTTP_SEE_OTHER);
        }

        return $this->render('api/search.html.twig');
    }
}