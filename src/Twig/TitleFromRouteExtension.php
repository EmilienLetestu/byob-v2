<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 30/07/2018
 * Time: 16:55
 */

namespace App\Twig;


use Symfony\Component\HttpFoundation\Request;
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
     * @param string $routeName
     * @return string
     */
    public function titleFilter(string $routeName): string
    {
        $routeNames = [
            'dashboard'          => 'Tableau de bord',
            'createWarehouse'    => 'Ajouter un entrepôt',
            'createUser'         => 'Ajouter un utilisateur',
            'createProduct'      => 'Ajouter un produit',
            'productList'        => 'Catalogue produits',
            'userList'           => 'Liste des utilisateurs',
            'warehouseList'      => 'Liste des entrepôts',
            'arrival'            => 'En attente de validation',
            'customerList'       => 'Liste des clients',
            'createOrder'        => 'Démarrer la commande',
            'addProductToOrder'  => 'Ajouter un produit à la commande : ',
            'orderList'          => 'Liste des commandes',
            'createCustomer'     => 'Ajoluter un client',
            'addContactToCustomer' => 'Ajouter un contact',
            'orderManagement'    => 'Gestion des commandes'
        ];

        return $routeNames[$routeName];
    }
}