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
use Miky\Component\Registry\ServiceRegistryInterface;


class DataSourceProvider implements DataSourceProviderInterface
{
    /**
     * @var ServiceRegistryInterface
     */
    private $driversRegistry;

    /**
     * @param ServiceRegistryInterface $driversRegistry
     */
    public function __construct(ServiceRegistryInterface $driversRegistry)
    {
        $this->driversRegistry = $driversRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSource(Grid $grid, Parameters $parameters)
    {
        $driverName = $grid->getDriver();

        if (!$this->driversRegistry->has($driverName)) {
            throw new UnsupportedDriverException($driverName);
        }

        /** @var DriverInterface $driver */
        $driver = $this->driversRegistry->get($driverName);

        return $driver->getDataSource($grid->getDriverConfiguration(), $parameters);
    }
}
