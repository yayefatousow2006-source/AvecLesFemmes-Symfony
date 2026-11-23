<?php

namespace App\DTO;

use App\Entity\Exercice;
use App\Service\DateService;

final readonly class ExerciceEnCoursDTO
{
    public function __construct(
        public int $id,
        public string $statutValue,
        public string $statutLabel,
        public string $createdAt,
        public string $updatedAt,
    ) {
    }

    public static function fromEntity(Exercice $exercice): self
    {
        $statut = $exercice->getStatut();

        return new self(
            id: (int) $exercice->getId(),
            statutValue: $statut->value,
            statutLabel: $statut->label(),
            createdAt: DateService::formatDate($exercice->getCreatedAt()),
            updatedAt: DateService::formatDate($exercice->getUpdatedAt()),
        );
    }
}