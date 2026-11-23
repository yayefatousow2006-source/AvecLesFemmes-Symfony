<?php

namespace App\DTO;

final readonly class PageDTO
{
    public int $nombreDePages;

    /**
     * @param array<int, mixed> $elements
     */
    public function __construct(
        public array $elements,
        public int $pageEnCours,
        public int $limit,
        public int $totalElement,
    ) {
        $this->nombreDePages = max(1, (int) ceil($this->totalElement / max(1, $this->limit)));
    }

    public function hasPrevious(): bool
    {
        return $this->pageEnCours > 1;
    }

    public function hasNext(): bool
    {
        return $this->pageEnCours < $this->nombreDePages;
    }
}