<?php

namespace App\Controller;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/member', name: 'member_')]
class MemberController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MemberRepository $memberRepository): Response
    {
        return $this->render('member/index.html.twig', [
            'members' => $memberRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function show(
        #[MapEntity(id: 'id')]
        Member $member
    ): Response {
        return $this->render('member/show.html.twig', [
            'member' => $member,
        ]);
    }

}
