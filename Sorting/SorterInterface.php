<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Component\Grid\Sorting;

use Miky\Component\Grid\Data\DataSourceInterface;
use Miky\Component\Grid\Definition\Grid;
use Miky\Component\Grid\Parameters;


interface SorterInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param Grid $grid
     * @param Parameters $parameters
     */
    public function sort(DataSourceInterface $dataSource, Grid $grid, Parameters $parameters);
}
