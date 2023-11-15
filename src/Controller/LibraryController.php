<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/library', name: 'library_')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
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
        $isAdmin = $this->isGranted('ROLE_ADMIN');
        $isOwner = $this->getUser()->getUserIdentifier() === $library->getMember()->getUser()->getUserIdentifier();

        if (!$isAdmin && !$isOwner) {
            throw $this->createAccessDeniedException("You cannot access another member's library!");
        }

        return $this->render('library/show.html.twig', [
            'library' => $library
        ]);
    }

}
