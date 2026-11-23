<?php

namespace App\Controller;

use App\DTO\GroupSearchDTO;
use App\Form\GroupSearchType;
use App\Service\GroupementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GroupementController extends AbstractController
{
    public function __construct(
        private readonly GroupementService $groupementService,
    ) {
    }

    #[Route('/groupement', name: 'app_groupement', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $searchDTO = new GroupSearchDTO();
        $form = $this->createForm(GroupSearchType::class, $searchDTO);
        $form->handleRequest($request);

        $page = max(1, $request->query->getInt('page', 1));
        $limit = 10;

        if ($request->query->has('page') && $request->query->getInt('page', 1) < 1) {
            return $this->redirectToRoute('app_groupement', ['page' => 1]);
        }

        $pageDTO = $this->groupementService->getPaginatedGroupements($searchDTO, $page, $limit);

        if ($page > $pageDTO->nombreDePages) {
            $pageDTO = $this->groupementService->getPaginatedGroupements($searchDTO, $pageDTO->nombreDePages, $limit);
        }

        return $this->render('groupement/index.html.twig', [
            'formSearchGroupement' => $form->createView(),
            'pageDTO' => $pageDTO,
            'groupements' => $pageDTO->elements,
        ]);
    }
}