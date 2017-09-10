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

    const TYPE_EQUAL = 'equal';
    const TYPE_EMPTY = 'empty';
    const TYPE_NOT_EMPTY = 'not_empty';
    const TYPE_CONTAINS = 'contains';
    const TYPE_NOT_CONTAINS = 'not_contains';
    const TYPE_STARTS_WITH = 'starts_with';
    const TYPE_ENDS_WITH = 'ends_with';
    const TYPE_IN = 'in';
    const TYPE_NOT_IN = 'not_in';

    /**
     * {@inheritdoc}
     */
    public function apply(DataSourceInterface $dataSource, $name, $data, array $options)
    {
        $expressionBuilder = $dataSource->getExpressionBuilder();

        if (!is_array($data)) {
            $data = ['type' => self::TYPE_CONTAINS, 'value' => $data];
        }

        $fields = array_key_exists('fields', $options) ? $options['fields'] : [$name];

        $type = $data['type'];
        $value = array_key_exists('value', $data) ? $data['value'] : null;

        if (!in_array($type, [self::TYPE_NOT_EMPTY, self::TYPE_EMPTY], true) && '' === trim($value)) {
            return;
        }

        if (1 === count($fields)) {
            $dataSource->restrict($this->getExpression($expressionBuilder, $type, current($fields), $value));

            return;
        }

        $expressions = [];
        foreach ($fields as $field) {
            $expressions[] = $this->getExpression($expressionBuilder, $type, $field, $value);
        }

        $dataSource->restrict($expressionBuilder->orX(...$expressions));
    }

    public function getFormClass(){
        return 'Miky\Bundle\GridBundle\Form\Type\Filter\StringFilterType';
    }

    /**
     * @param ExpressionBuilderInterface $expressionBuilder
     * @param string $type
     * @param string $field
     * @param mixed  $value
     *
     * @return ExpressionBuilderInterface
     */
    private function getExpression(ExpressionBuilderInterface $expressionBuilder, $type, $field, $value)
    {
        switch ($type) {
            case self::TYPE_EQUAL:
                return $expressionBuilder->equals($field, $value);
            case self::TYPE_EMPTY:
                return $expressionBuilder->isNull($field);
            case self::TYPE_NOT_EMPTY:
                return $expressionBuilder->isNotNull($field);
            case self::TYPE_CONTAINS:
                return $expressionBuilder->like($field, '%'.$value.'%');
            case self::TYPE_NOT_CONTAINS:
                return $expressionBuilder->notLike($field, '%'.$value.'%');
            case self::TYPE_STARTS_WITH:
                return $expressionBuilder->like($field, $value.'%');
            case self::TYPE_ENDS_WITH:
                return $expressionBuilder->like($field, '%'.$value);
            case self::TYPE_IN:
                return $expressionBuilder->in($field, array_map('trim', explode(',', $value)));
            case self::TYPE_NOT_IN:
                return $expressionBuilder->notIn($field, array_map('trim', explode(',', $value)));
            default:
                throw new \InvalidArgumentException(sprintf('Could not get an expression for type "%s"!', $type));
        }
    }
}
