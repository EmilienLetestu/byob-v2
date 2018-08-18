<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 18/08/2018
 * Time: 16:30
 */

namespace App\Builder\DashboardBuilder;


use App\Builder\Interfaces\DashboardBuilderInterface;

class DashboardBuilder
{
    public function build(DashboardBuilderInterface $builder): Dashboard
    {
        $builder->createDashBoard();
        $builder->addDataMonitoring();
        $builder->addAlias();

        return $builder->getDashboard();
    }
}