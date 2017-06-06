<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Component\Grid\Filter;

use Miky\Component\Grid\Data\DataSourceInterface;
use Miky\Component\Grid\Filtering\FilterInterface;


class BooleanFilter implements FilterInterface
{
    const TRUE  = 'true';
    const FALSE = 'false';

    /**
     * {@inheritdoc}
     */
    public function apply(DataSourceInterface $dataSource, $name, $data, array $options)
    {
        if (empty($data)) {
            return;
        }

        $field = isset($options['field']) ? $options['field'] : $name;

        $data = self::TRUE === $data;

        $dataSource->restrict($dataSource->getExpressionBuilder()->equals($field, $data));
    }

    public function getFormClass(){
        return 'Miky\Bundle\GridBundle\Form\Type\Filter\BooleanFilterType';
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'boolean';
    }
}
