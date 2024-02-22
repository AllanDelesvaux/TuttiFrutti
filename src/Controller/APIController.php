<?php

namespace App\Controller;

use App\Service\APIAccess;
use App\Entity\Album;
use Doctrine\ORM\EntityManagerInterface;
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

        return $this->render('api/result.html.twig', [
            'albumList' => $this->searchInformation,
            'userResearch' => $fruit,
            'searchSize' => sizeof($this->searchInformation),
        ]);
    }

    #[Route(path: '/searchingPage/addFavori/{fruit}/{id}', name: 'favori_add')]
    public function addFav(APIAccess $apiAccess,EntityManagerInterface $entityManager,string $fruit ,int $id): Response
    {
        $this->searchInformation = $apiAccess->fetchDiscogsWithId($id);

        $album = new Album();
        $album->setNom($this->searchInformation['title']);
        $album->setFruit($fruit);
        $album->setAnnee($this->searchInformation['year']);
        $album->setArtistes($this->searchInformation['artists'][0]['name']);
        $album->setLabel($this->searchInformation['labels'][0]['name']);
        $album->setGenre($this->searchInformation['genres'][0]);
        $album->setFormat('');
        $album->setTracklist('');
        $album->setUrl($this->searchInformation['images'][0]['resource_url']);

        $user=$this->getUser();
        $user->addUserAlbum($album);

        $entityManager->persist($album);

        $entityManager->flush();

        return new Response('Album' .$this->searchInformation['title']. ' added to your favorites');
    }

}