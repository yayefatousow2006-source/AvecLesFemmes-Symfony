<?php

namespace App\DTO;

final class GroupSearchDTO
{
    public function __construct(
        public ?string $q = null,
    ) {
    }
}