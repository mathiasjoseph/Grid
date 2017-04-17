<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Component\Grid\Provider;

use Miky\Component\Grid\Definition\Grid;

/**
 * @author Paweł Jędrzejewski <pawel@svaluelius.org>
 */
interface GridProviderInterface
{
    /**
     * @param string $code
     *
     * @return Grid
     *
     * @throws UndefinedGridException
     */
    public function get($code);
}
