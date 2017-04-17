<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Component\Grid\FieldTypes;

use Miky\Component\Grid\Definition\Field;
use Symfony\Component\OptionsResolver\OptionsResolver;


interface FieldTypeInterface
{
    /**
     * Return a HTML representation of the $field using the given $data and
     * $options.
     *
     * @param Field $field
     * @param mixed $data
     * @param array $options
     *
     * @return mixed
     */
    public function render(Field $field, $data, array $options);

    /**
     * Configure options for this field type.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver);
}
