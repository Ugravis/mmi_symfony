<?php

namespace App\twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
            new TwigFilter('stars', [$this, 'stars'], ['is_safe' => ['html']]),
            new TwigFilter('dateFr', [$this, 'formatDateFr']),
            new TwigFilter('formatPhone', [$this, 'formatPhone'])
        ];
    }

    public function formatPrice(
      $number, 
      $symbol = '€', 
      $decimals = 0, 
      $decPoint = '.', 
      $thousandsSep = ','
    )
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = $price. ' €';
        return $price;
    }

    public function stars($note)
    {
        $html = '';
        for ($i = 0; $i < $note; $i++) {
            $html .= '<strong>*</strong>';
        }
        for ($i = 0; $i < 5 - $note; $i++) {
            $html .= '-';
        }

        return $html;
    }

    public function formatDateFr($date)
    {
        if (!$date instanceof \DateTimeInterface) {
            try {
                $date = new \DateTime($date);
            } catch (\Exception $e) {
                return $date;
            }
        }
        return $date->format('d/m/Y');
    }

    public function formatPhone($phone)
    {
        $cleaned = str_replace([' ', '.', '-'], '', $phone);

        if (str_starts_with($cleaned, '+33')) {
            return substr($cleaned, 0, 3) . ' ' . substr($cleaned, 3, 1) . ' ' . 
            implode(' ', str_split(substr($cleaned, 4), 2));
        }

        return implode(' ', str_split($cleaned, 2));
    }
}