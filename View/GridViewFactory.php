<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Component\Grid\View;

use Miky\Component\Grid\Data\DataProviderInterface;
use Miky\Component\Grid\Definition\Grid;
use Miky\Component\Grid\Parameters;


class GridViewFactory implements GridViewFactoryInterface
{
    /**
     * @var DataProviderInterface
     */
    private $dataProvider;

    /**
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function create(Grid $grid, Parameters $parameters)
    {
        return new GridView($this->dataProvider->getData($grid, $parameters), $grid, $parameters);
    }
}
