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

use Miky\Bundle\GridBundle\Doctrine\ORM\Driver;
use Miky\Component\Grid\Definition\Grid;
use Miky\Component\Grid\Parameters;


class DataSourceProvider implements DataSourceProviderInterface
{
    /**
     * @var Driver
     */
    private $driver;

    /**
     * @param Driver
     */
    public function __construct(Driver $driver)
    {
        $this->driver= $driver;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSource(Grid $grid, Parameters $parameters)
    {

        return $this->driver->getDataSource($grid->getDriverConfiguration(), $parameters);
    }
}
