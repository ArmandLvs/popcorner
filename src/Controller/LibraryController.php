<?php

namespace App\Controller;

use App\Entity\Library;
use App\Entity\Movie;
use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\MovieType;

#[Route('/library', name: 'library_')]
class LibraryController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(LibraryRepository $libraryRepository): Response
    {
        return $this->render('library/index.html.twig', [
            'libraries' => $libraryRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(
        #[MapEntity(id: 'id')]
        Library $library
    ): Response
    {
        return $this->render('library/show.html.twig', [
            'library' => $library
        ]);
    }

    #[Route('/{library_id}/movie/new', name: 'movie_new', requirements: ['library_id' => '\d+'], methods: ['GET', 'POST'])]
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

        return $this->render('library/movie_new.html.twig', [
            'library' => $library,
            'movie' => $movie,
            'form' => $form,
        ]);
    }

}
