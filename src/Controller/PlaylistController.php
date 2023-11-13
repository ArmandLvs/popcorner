<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Playlist;
use App\Form\PlaylistType;
use App\Repository\PlaylistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/playlist', name: 'playlist_')]
class PlaylistController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PlaylistRepository $playlistRepository): Response
    {
        return $this->render('playlist/index.html.twig', [
            'playlists' => $playlistRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $playlist = new Playlist();
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($playlist);
            $entityManager->flush();

            return $this->redirectToRoute('playlist_show', ['id' => $playlist->getId()]);
        }

        return $this->render('playlist/new.html.twig', [
            'playlist' => $playlist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Playlist $playlist): Response
    {
        if (!$playlist->isPublished()) {
            throw $this->createAccessDeniedException('The playlist is not published.');
        }

        return $this->render('playlist/show.html.twig', [
            'playlist' => $playlist,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Playlist $playlist, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('playlist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('playlist/edit.html.twig', [
            'playlist' => $playlist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Playlist $playlist, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $playlist->getId(), $request->request->get('_token'))) {
            $entityManager->remove($playlist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('playlist_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{playlist_id}/movie/{movie_id}', name: 'movie_show', requirements: ['playlist_id' => '\d+', 'movie_id' => '\d+'])]
    public function showMovie(
        #[MapEntity(id: 'playlist_id')]
        Playlist $playlist,
        #[MapEntity(id: 'movie_id')]
        Movie $movie
    ): Response {
        if (!$playlist->isPublished()) {
            throw $this->createAccessDeniedException("Playlist does not exist or is private.");
        }

        if (!$playlist->getMovies()->contains($movie)) {
            throw $this->createNotFoundException("Movie not found in playlist.");
        }

        return $this->render('playlist/movie_show.html.twig', [
            'playlist' => $playlist,
            'movie' => $movie,
        ]);
    }
}
