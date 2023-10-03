<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class MovieController extends AbstractController
{
    #[Route('/movie/{id}', name: 'movie_show', requirements: ['id' => '\d+'])]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $em = $doctrine->getManager();
        $movie = $em->getRepository(Movie::class)->find($id);

        if (!$movie) {
            throw $this->createNotFoundException(
                'No movie found for id ' . $id
            );
        }

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
            'library' => $movie->getLibrary(),
            'member' => $movie->getLibrary()->getMember(),
        ]);
    }
}
