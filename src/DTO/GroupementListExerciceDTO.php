<?php

namespace App\DTO;

use App\Entity\Groupement;

final readonly class GroupementListExerciceDTO
{
    public function __construct(
        public int $id,
        public string $nom,
        public string $adresse,
        public string $telephone,
        public ?ExerciceEnCoursDTO $exerciceEnCours,
    ) {
    }

    public static function fromEntity(Groupement $groupement, ?ExerciceEnCoursDTO $exerciceEnCours): self
    {
        return new self(
            id: (int) $groupement->getId(),
            nom: (string) $groupement->getNom(),
            adresse: (string) $groupement->getAdresse(),
            telephone: (string) $groupement->getTelephone(),
            exerciceEnCours: $exerciceEnCours,
        );
    }
}