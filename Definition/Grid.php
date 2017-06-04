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


class Grid
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $resourceAlias;


    /**
     * @var array
     */
    private $driverConfiguration;

    /**
     * @var array
     */
    private $sorting = [];

    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var array
     */
    private $filters = [];

    /**
     * @var array
     */
    private $batchActions = [];

    /**
     * @var array
     */
    private $actionGroups = [];

    /**
     * @param string $code
     * @param array $driverConfiguration
     */
    private function __construct($code, $resourceAlias, array $driverConfiguration)
    {
        $this->code = $code;
        $this->resourceAlias = $resourceAlias;
        $this->driverConfiguration = $driverConfiguration;
    }

    /**
     * @param string $code
     * @param array $driverConfiguration
     *
     * @return Grid
     */
    public static function fromCodeAndDriverConfiguration($code, $resourceAlias, array $driverConfiguration)
    {
        return new Grid($code, $resourceAlias, $driverConfiguration);
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function getDriverConfiguration()
    {
        return $this->driverConfiguration;
    }

    /**
     * @param array $driverConfiguration
     */
    public function setDriverConfiguration(array $driverConfiguration)
    {
        $this->driverConfiguration = $driverConfiguration;
    }

    /**
     * @return array
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * @param array $sorting
     */
    public function setSorting(array $sorting)
    {
        $this->sorting = $sorting;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param Field $field
     */
    public function addField(Field $field)
    {
        $name = $field->getName();

        if ($this->hasField($name)) {
            throw new \InvalidArgumentException(sprintf('Field "%s" already exists.', $name));
        }

        $this->fields[$name] = $field;
    }

    /**
     * @param string $name
     */
    public function getField($name)
    {
        if (!$this->hasField($name)) {
            throw new \InvalidArgumentException(sprintf('Field "%s" does not exist.', $name));
        }

        return $this->fields[$name];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasField($name)
    {
        return array_key_exists($name, $this->fields);
    }

    /**
     * @return array
     */
    public function getActionGroups()
    {
        return $this->actionGroups;
    }

    /**
     * @return BatchAction[]
     */
    public function getBatchActions()
    {
        return $this->batchActions;
    }


    /**
     * @param ActionGroup $actionGroup
     */
    public function addActionGroup(ActionGroup $actionGroup)
    {
        $name = $actionGroup->getName();

        if ($this->hasActionGroup($name)) {
            throw new \InvalidArgumentException(sprintf('ActionGroup "%s" already exists.', $name));
        }

        $this->actionGroups[$name] = $actionGroup;
    }

    /**
     * @param BatchAction $batchAction
     */
    public function addBatchAction(BatchAction $batchAction)
    {
        $name = $batchAction->getName();

        if ($this->hasBatchAction($name)) {
            throw new \InvalidArgumentException(sprintf('BatchAction "%s" already exists.', $name));
        }

        $this->batchActions[$name] = $batchAction;
    }


    /**
     * @param string $name
     */
    public function getActionGroup($name)
    {
        if (!$this->hasActionGroup($name)) {
            throw new \InvalidArgumentException(sprintf('ActionGroup "%s" does not exist.', $name));
        }

        return $this->actionGroups[$name];
    }

    /**
     * @param string $name
     */
    public function getBatchAction($name)
    {
        if (!$this->hasBatchAction($name)) {
            throw new \InvalidArgumentException(sprintf('BatchAction "%s" does not exist.', $name));
        }

        return $this->batchActions[$name];
    }

    /**
     * @param string $groupName
     *
     * @return Action[]
     */
    public function getActions($groupName)
    {
        return $this->getActionGroup($groupName)->getActions();
    }


    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasActionGroup($name)
    {
        return array_key_exists($name, $this->actionGroups);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasBatchAction($name)
    {
        return array_key_exists($name, $this->batchActions);
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param Filter $filter
     */
    public function addFilter(Filter $filter)
    {
        if ($this->hasFilter($name = $filter->getName())) {
            throw new \InvalidArgumentException(sprintf('Filter "%s" already exists.', $name));
        }

        $this->filters[$name] = $filter;
    }

    /**
     * @param string $name
     *
     * @return Filter
     */
    public function getFilter($name)
    {
        if (!$this->hasFilter($name)) {
            throw new \InvalidArgumentException(sprintf('Filter "%s" does not exist.', $name));
        }

        return $this->filters[$name];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasFilter($name)
    {
        return array_key_exists($name, $this->filters);
    }

    /**
     * @return string
     */
    public function getResourceAlias()
    {
        return $this->resourceAlias;
    }


}
