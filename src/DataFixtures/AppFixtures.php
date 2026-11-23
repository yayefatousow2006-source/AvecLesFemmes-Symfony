<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Entity\Groupement;
use App\Enum\StatutExercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 15; $i++) {
            $groupement = (new Groupement())
                ->setNom("Groupement Femmes $i")
                ->setAdresse($i % 2 === 0 ? "Dakar $i" : "Thiès $i")
                ->setTelephone('77' . str_pad((string) (1000000 + $i), 7, '0', STR_PAD_LEFT));

            $exerciceCloture = (new Exercice())
                ->setStatut(StatutExercice::CLOTURE)
                ->setGroupement($groupement);
            $manager->persist($exerciceCloture);

            if ($i % 4 !== 0) {
                $exerciceEnCours = (new Exercice())
                    ->setStatut(StatutExercice::EN_COURS)
                    ->setGroupement($groupement);
                $manager->persist($exerciceEnCours);
            }

            $manager->persist($groupement);
        }

        $manager->flush();
    }
}