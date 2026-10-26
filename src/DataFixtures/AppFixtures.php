<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Groupement;
use App\Entity\Membre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1. Création d'un Rôle de test
        $role = new Role();
        $role->setNom('Administrateur');
        $manager->persist($role);

        // 2. Création d'un Groupement de test
        $groupement = new Groupement();
        $groupement->setNom('Groupement Test');
        $groupement->setAdresse('Adresse par défaut');
        $groupement->setTelephone('770000000');
        $manager->persist($groupement);

        // 3. Création d'un Membre de test
        $membre = new Membre();
        $membre->setNomComplet('Fatou Sow');
        $manager->persist($membre);

        // Enregistrement de tout dans la base de données
        $manager->flush();
    }
}