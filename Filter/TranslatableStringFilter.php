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
use Miky\Component\Grid\Data\ExpressionBuilderInterface;
use Miky\Component\Grid\Filtering\FilterInterface;


class TranslatableStringFilter implements FilterInterface
{
    const NAME = 'string';


    /**
     * {@inheritdoc}
     */
    public function apply(DataSourceInterface $dataSource, $name, $data, array $options)
    {
        $expressionBuilder = $dataSource->getExpressionBuilder();

        if (!is_array($data)) {
            $data = ['value' => $data];
        }

        $fields = array_key_exists('fields', $options) ? $options['fields'] : [$name];

        $value = array_key_exists('value', $data) ? $data['value'] : null;

        if ('' === trim($value)) {
            return;
        }

        if (1 === count($fields)) {
            $dataSource->restrict($this->getExpression($expressionBuilder, current($fields), $value));

            return;
        }

        $expressions = [];
        foreach ($fields as $field) {
            $expressions[] = $this->getExpression($expressionBuilder, $field, $value);
        }

        $dataSource->restrict($expressionBuilder->orX(...$expressions));
    }

    public function getFormClass(){
        return 'Miky\Bundle\GridBundle\Form\Type\Filter\StringFilterType';
    }

    /**
     * @param ExpressionBuilderInterface $expressionBuilder
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionBuilderInterface
     */
    private function getExpression(ExpressionBuilderInterface $expressionBuilder, $field, $value)
    {
        return $expressionBuilder->like($field, '%'.$value.'%');
    }

}
