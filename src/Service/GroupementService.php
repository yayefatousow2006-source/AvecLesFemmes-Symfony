<?php

namespace App\Service;

use App\DTO\ExerciceEnCoursDTO;
use App\DTO\GroupementListExerciceDTO;
use App\DTO\GroupSearchDTO;
use App\DTO\PageDTO;
use App\Entity\Exercice;
use App\Entity\Groupement;
use App\Enum\StatutExercice;
use App\Repository\GroupementRepository;

final class GroupementService
{
    public function __construct(
        private readonly GroupementRepository $groupementRepository,
        private readonly PaginationService $paginationService,
    ) {
    }

    public function getPaginatedGroupements(GroupSearchDTO $searchDTO, int $page = 1, int $limit = 10): PageDTO
    {
        $qb = $this->groupementRepository->createSearchQueryBuilder($searchDTO->q);
        $pageDTO = $this->paginationService->paginate($qb, $page, $limit);

        $dtos = array_map(function (Groupement $groupement): GroupementListExerciceDTO {
            $exerciceEnCours = null;
            foreach ($groupement->getExercices() as $exercice) {
                if ($exercice instanceof Exercice && $exercice->getStatut() === StatutExercice::EN_COURS) {
                    $exerciceEnCours = ExerciceEnCoursDTO::fromEntity($exercice);
                    break;
                }
            }

            return GroupementListExerciceDTO::fromEntity($groupement, $exerciceEnCours);
        }, $pageDTO->elements);

        return new PageDTO(
            elements: $dtos,
            pageEnCours: $pageDTO->pageEnCours,
            limit: $pageDTO->limit,
            totalElement: $pageDTO->totalElement,
        );
    }
}