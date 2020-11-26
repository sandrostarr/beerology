<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class WordSuffixTwig extends AbstractExtension
{

    public function getFilters()
    {
        return [
            new TwigFilter('suffix', [$this, 'formatSuffix']),
        ];
    }

    public function formatSuffix($number, $page)
    {
        $number_mod = $number % 10;

        if ($number_mod == 1) {
            $modified_text = $number . ' статья';
        } else if ($number_mod >= 2 && $number_mod <= 4) {
            $modified_text = $number . ' статьи';
        } else {
            $modified_text = $number . ' статей';
        }

        if ($number >= 5 && $number <= 20) {
            $modified_text = $number . ' статей';
        }

        return $modified_text;
    }
}