<?php

namespace App\Controller;

use App\Entity\Library;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class LibraryController extends AbstractController
{
    #[Route('/library', name: 'library')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $database = $doctrine->getManager(); // Get the Doctrine entity manager
        $libraries = $database->getRepository(Library::class)->findAll(); // Find all the libraries

        return $this->render('library/index.html.twig', [
            'libraries' => $libraries
        ]);
    }

    #[Route('/library/{id}', name: 'library_show', requirements: ['id' => '\d+'])]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $database = $doctrine->getManager(); // Get the Doctrine entity manager
        $library = $database->getRepository(Library::class)->find($id); // Find the library with id $id

        // If no library is found, throw a 404 HTTP error
        if (!$library) {
            throw $this->createNotFoundException(
                'No library found for id ' . $id
            );
        }

        // Render the template
        return $this->render('library/show.html.twig', [
            'library' => $library
        ]);
    }
}
