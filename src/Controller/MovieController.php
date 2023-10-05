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
        $database = $doctrine->getManager(); // Get the Doctrine entity manager
        $movie = $database->getRepository(Movie::class)->find($id); // Find the movie with id $id

        // If no movie is found, throw a 404 HTTP error
        if (!$movie) {
            throw $this->createNotFoundException(
                'No movie found for id ' . $id
            );
        }

        // Render the template
        return $this->render('movie/show.html.twig', [
            'movie' => $movie, // Pass the movie to the template
            'library' => $movie->getLibrary(), // Pass the library to the template
            'member' => $movie->getLibrary()->getMember(), // Pass the member to the template
        ]);
    }
}
