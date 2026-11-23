<?php

namespace App\Service;

final class DateService
{
    public static function formatDate(?\DateTimeInterface $date, string $format = 'd/m/Y'): string
    {
        if ($date === null) {
            return '-';
        }

        return $date->format($format);
    }

    public static function joursRestants(\DateTimeInterface $dateLimite, ?\DateTimeInterface $dateReference = null): int
    {
        $debut = \DateTimeImmutable::createFromInterface($dateReference ?? new \DateTimeImmutable());
        $fin = \DateTimeImmutable::createFromInterface($dateLimite);

        $diff = $debut->diff($fin);
        $jours = (int) $diff->format('%r%a');

        return max(0, $jours);
    }
}
