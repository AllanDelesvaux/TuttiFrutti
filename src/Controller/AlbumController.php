<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\User;
use App\Form\SearchFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class AlbumController extends AbstractController
{

    ///CREATE/// 
    #[Route('/createAlbum', name: 'create_album')]
    public function createAlbum(EntityManagerInterface $entityManager): Response
    {
        $album = new Album();
        $album->setNom('Arise');
        $album->setFruit('banane');
        $album->setAnnee('2024');
        $album->setArtistes('top');
        $album->setLabel('rizz');
        $album->setGenre('jazz');
        $album->setFormat('mp4');
        $album->setTracklist('1. Wow 2. Blabla 3.Ici et laa');
        $album->setUrl('https://i.discogs.com/1Xuu3z4R1dmTMv8rh9V1lpyNKW9uFtdGXgGydJWnCt0/rs:fit/g:sm/q:90/h:595/w:600/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTc0NDU5/NjEtMTcwNzI0NzI1/NC0zNTIzLmpwZWc.jpeg');

        $entityManager->persist($album);

        $entityManager->flush();

        return new Response('Saved new album with id '.$album->getId());
    }

    ///SHOW/// 
    #[Route('/album/{id}', name: 'album_show')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $album = $entityManager->getRepository(Album::class)->find($id);

        if (!$album) {
            throw $this->createNotFoundException(
                'No album found for id '.$id
            );
        }
        return new Response('Check out this great album: '.$album->getNom());
    }


    ///UPDATE/// 
    #[Route('/album/edit/{id}', name: 'album_edit')]
    public function update(EntityManagerInterface $entityManager, int $id): Response
    {
        $album = $entityManager->getRepository(Album::class)->find($id);

        if (!$album) {
            throw $this->createNotFoundException(
                'No album found for id '.$id
            );
        }

        $album->setNom('Arise');
        $album->setFruit('Fraise');
        $album->setAnnee('2021');
        $album->setArtistes('Top');
        $album->setLabel('Genius');
        $album->setGenre('Rock');
        $album->setFormat('mp4');
        $album->setTracklist('1 blabla, 2 blublu');
        $entityManager->flush();

        return $this->redirectToRoute('album_show', [
            'id' => $album->getId()
        ]);
    }

    #[Route('/album', name: 'app_album')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $albums = $user->getUserAlbum();

        return $this->render('album/accueil.html.twig', [
            'user' => $user,
            'albums' => $albums,
        ]);
    }
    
    #[Route("/albumsearch", name:"album_search")]
    public function search(Request $request): Response
    {
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fruit = $form->get('fruit')->getData();
            return $this->redirectToRoute('album_results', ['Fruit' => $fruit]);
        }

        return $this->render('album/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/albumresult/{Fruit}', name: 'album_results')]
    public function findAllByFruit(EntityManagerInterface $entityManager, string $Fruit): Response
    {

        $albums = $entityManager->getRepository(Album::class)->findBy(['Fruit' => $Fruit]);

        return $this->render('album/results.html.twig', [
            'albums' => $albums,
            'fruit' => $Fruit,
        ]);
    }
}
