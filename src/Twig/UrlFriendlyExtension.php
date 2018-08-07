<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 07/08/2018
 * Time: 12:13
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class UrlFriendlyExtension extends AbstractExtension
{
    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('toUrl', [$this, 'urlFriendlyFilter'])
        ];
    }

    /**
     * @param string $string
     * @return string
     */
    public function urlFriendlyFilter(string $string): string
    {
        return str_replace(' ','-', $string);
    }
}