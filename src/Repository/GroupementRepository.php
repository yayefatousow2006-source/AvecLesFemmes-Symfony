<?php

namespace App\Repository;

use App\Entity\Groupement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Groupement>
 */
class GroupementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupement::class);
    }

    public function createSearchQueryBuilder(?string $q): QueryBuilder
    {
        $qb = $this->createQueryBuilder('g')
            ->orderBy('g.id', 'ASC');

        $search = $q !== null ? trim($q) : '';

        if ($search !== '') {
            $qb->andWhere(
                $qb->expr()->orX(
                    'LOWER(g.nom) LIKE LOWER(:q)',
                    'LOWER(g.adresse) LIKE LOWER(:q)',
                    'LOWER(g.telephone) LIKE LOWER(:q)'
                )
            )
            ->setParameter('q', '%' . $search . '%');
        }

        return $qb;
    }
}