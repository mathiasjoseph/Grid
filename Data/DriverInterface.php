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

use Miky\Component\Grid\Parameters;


interface DriverInterface
{
    /**
     * @param array $configuration
     * @param Parameters $parameters
     *
     * @return DataSourceInterface
     */
    public function getDataSource(array $configuration, Parameters $parameters);
}
