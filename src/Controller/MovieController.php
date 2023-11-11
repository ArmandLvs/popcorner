<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

class MovieController extends AbstractController
{
    #[Route('/movie/{id}', name: 'movie_show', requirements: ['id' => '\d+'])]
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
}
