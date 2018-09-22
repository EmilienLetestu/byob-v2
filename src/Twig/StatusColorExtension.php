<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 22/09/2018
 * Time: 09:26
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class StatusColorExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('colorClass', [$this, 'colorClass'])
        ];
    }

    public function colorClass($status)
    {
        switch ($status):
            case 'payé et validé':
                $status = 'paid';
                break;
            case 'en préparation':
                $status = 'assembling';
                break;
            case 'en attente d\'enlèvement':
                $status = 'to-collect';
                break;
            case 'en attente de livraison':
                $status = 'pending-delivery';
                break;
            case 'livraison en cours':
                $status = 'delivering';
                break;
            case 'livré';
                $status = 'delivered';
                break;
            endswitch;

            return $status;
    }
}