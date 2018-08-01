<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 01/08/2018
 * Time: 22:32
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class StatusIconExtension extends AbstractExtension
{
    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('statusIcon', [$this, 'iconFilter'])
        ];
    }

    /**
     * @param bool $status
     * @return string
     */
    public function iconFilter(bool $status): string
    {
        return $status === true ? 'done' : 'close';
    }
}