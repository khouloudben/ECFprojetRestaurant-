<?php

namespace App\Twig;

class CustomTwigExtension extends \Twig\Extension\AbstractExtension
{
    public function getFilters()
    {
        return [
            new \Twig\TwigFilter('format_hour', [$this, 'formatHour']),
        ];
    }

    public function formatHour(\DateTimeInterface $dateTime)
    {
        return $dateTime->format('H\hi');
    }
}
