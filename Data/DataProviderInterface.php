<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Component\Grid\Data;

use Miky\Component\Grid\Definition\Grid;
use Miky\Component\Grid\Parameters;


interface DataProviderInterface
{
    /**
     * @param Grid $grid
     * @param array $parameters
     *
     * @return mixed
     */
    public function getData(Grid $grid, Parameters $parameters);
}
