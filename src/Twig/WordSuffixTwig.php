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
            if($page == 'news'){
                $modified_text = $number . ' статья';
            }
            if($page == 'countries'){
                $modified_text = $number . ' страна';
            }
            if($page == 'styles'){
                $modified_text = $number . ' стиль';
            }
        } else if ($number_mod >= 2 && $number_mod <= 4) {
            if($page == 'news') {
                $modified_text = $number . ' статьи';
            }
            if($page == 'countries') {
                $modified_text = $number . ' страны';
            }
            if($page == 'styles') {
                $modified_text = $number . ' стиля';
            }
        } else {
            if($page == 'news'){
                $modified_text = $number . ' статей';
            }
            if($page == 'countries'){
                $modified_text = $number . ' стран';
            }
            if($page == 'styles'){
                $modified_text = $number . ' стилей';
            }
        }


        if ($number >= 5 && $number <= 20) {
            if($page == 'news') {
                $modified_text = $number . ' статей';
            }
            if($page == 'countries') {
                $modified_text = $number . ' статей';
            }
            if($page == 'styles') {
                $modified_text = $number . ' статей';
            }
        }

        return $modified_text;
    }
}