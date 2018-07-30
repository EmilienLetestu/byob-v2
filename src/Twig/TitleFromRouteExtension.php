<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 16:55
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TitleFromRouteExtension extends AbstractExtension
{
    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('title', [$this, 'titleFilter'])
        ];
    }

    /**
     * add your routes names in the array below to generate a title from the matching route name
     *
     * @param string $routeName
     * @return string
     */
    public function titleFilter(string $routeName): string
    {
        $routeNames = [
            'dashboard'       => 'Tableau de bord',
            'createWarehouse' => 'Ajouter un entrepôt'
        ];

        return $routeNames[$routeName];
    }
}