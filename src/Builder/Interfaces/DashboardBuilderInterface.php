<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 18/08/2018
 * Time: 16:05
 */

namespace App\Builder\Interfaces;


interface DashboardBuilderInterface
{
    public function createDashBoard();

    public function getDashboard();

    public function addDataMonitoring();
}