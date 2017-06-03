<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Component\Grid\Definition;


class BatchAction
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $label;

    /**
     * @var array
     */
    private $options = [];

    /**
     * @param string $name
     * @param string $label
     */
    private function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * @param string $name
     * @param string $label
     *
     * @return BatchAction
     */
    public static function fromNameAndType($name, $label)
    {
        $field = new BatchAction($name, $label);

        return $field;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }



    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }


}
