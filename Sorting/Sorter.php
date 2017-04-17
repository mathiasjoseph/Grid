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


class Sorter implements SorterInterface
{
    /**
     * {@inheritdoc}
     */
    public function sort(DataSourceInterface $dataSource, Grid $grid, Parameters $parameters)
    {
        $expressionBuilder = $dataSource->getExpressionBuilder();

        $sorting = $parameters->has('sorting') ? $parameters->get('sorting') : $grid->getSorting();

        foreach ($sorting as $field => $options) {
            if (!isset($options['direction'])) {
                $options['direction'] = 'desc';
            }

            $expressionBuilder->addOrderBy($options['path'], $options['direction']);
        }
    }
}
