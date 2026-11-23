<?php

namespace App\Service;

use App\DTO\PageDTO;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class PaginationService
{
    public function paginate(QueryBuilder $qb, int $page = 1, int $limit = 10): PageDTO
    {
        $page = max(1, $page);
        $limit = max(1, $limit);
        $offset = ($page - 1) * $limit;

        $query = clone $qb;
        $query->setFirstResult($offset)
            ->setMaxResults($limit);

        $paginator = new Paginator($query, fetchJoinCollection: true);
        $totalElement = count($paginator);
        $elements = iterator_to_array($paginator);

        return new PageDTO(
            elements: $elements,
            pageEnCours: $page,
            limit: $limit,
            totalElement: $totalElement,
        );
    }
}