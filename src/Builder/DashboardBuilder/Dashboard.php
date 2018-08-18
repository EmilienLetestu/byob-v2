<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 18/08/2018
 * Time: 16:11
 */

namespace App\Builder\DashboardBuilder;


class Dashboard
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param string $key
     * @param $value
     */
    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}