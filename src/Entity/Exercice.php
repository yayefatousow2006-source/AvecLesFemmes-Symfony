<?php

namespace App\Entity;

use App\Enum\StatutExercice;
use App\Trait\DateTimeTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Exercice
{
    use DateTimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: StatutExercice::class)]
    private StatutExercice $statut = StatutExercice::EN_COURS;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): StatutExercice
    {
        return $this->statut;
    }

    public function setStatut(StatutExercice $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}