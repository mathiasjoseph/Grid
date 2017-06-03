<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Component\Grid\Renderer;

use Miky\Component\Grid\Definition\Action;
use Miky\Component\Grid\Definition\Field;
use Miky\Component\Grid\Definition\Filter;
use Miky\Component\Grid\View\GridView;


interface GridRendererInterface
{
    /**
     * @param GridView $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function render(GridView $gridView, $template = null);

    /**
     * @param GridView $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(GridView $gridView, Field $field, $data);

    /**
     * @param GridView $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(GridView $gridView, Action $action, $data = null);

    /**
     * @param GridView $gridView
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderBatchActions(GridView $gridView, $data = null);

    /**
     * @param GridView $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(GridView $gridView, Filter $filter);
}
