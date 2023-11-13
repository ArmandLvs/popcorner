<?php

namespace App\Controller;

use App\Entity\Library;
use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\MovieType;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/movie', name: 'movie_')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
class MovieController extends AbstractController
{
    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function show(
        #[MapEntity(id: 'id')]
        Movie $movie
    ): Response
    {
        return $this->render('movie/show.html.twig', [
            'movie' => $movie, // Pass the movie to the template
            'library' => $movie->getLibrary(), // Pass the library to the template
            'member' => $movie->getLibrary()->getMember(), // Pass the member to the template
        ]);
    }

    #[Route('/new/{library_id}', name: 'new', requirements: ['library_id' => '\d+'], methods: ['GET', 'POST'])]
    public function newMovie(
        Request $request,
        EntityManagerInterface $entityManager,
        #[MapEntity(id: 'library_id')]
        Library $library
    ): Response {
        $movie = new Movie();
        $movie->setLibrary($library);
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('movie_show', ['id' => $movie->getId()]);
        }

        return $this->render('movie/new.html.twig', [
            'library' => $library,
            'movie' => $movie,
            'form' => $form,
        ]);
    }
}
