<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class GroupSearchDTO
{
    public function __construct(
        #[Assert\Length(
            min: 2,
            max: 100,
            minMessage: 'Saisis au moins {{ limit }} caractères pour filtrer.',
            maxMessage: 'La recherche ne peut pas dépasser {{ limit }} caractères.'
        )]
        public ?string $q = null,
    ) {
    }
}