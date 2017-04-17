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

use Miky\Component\Grid\Definition\ArrayToDefinitionConverterInterface;


class ArrayGridProvider implements GridProviderInterface
{
    /**
     * @var Grid[]
     */
    private $grids = [];

    /**
     * @param ArrayToDefinitionConverterInterface $converter
     * @param array $gridConfigurations
     */
    public function __construct(ArrayToDefinitionConverterInterface $converter, array $gridConfigurations)
    {
        foreach ($gridConfigurations as $code => $gridConfiguration) {
            $this->grids[$code] = $converter->convert($code, $gridConfiguration);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get($code)
    {
        if (!array_key_exists($code, $this->grids)) {
            throw new UndefinedGridException($code);
        }

        return $this->grids[$code];
    }
}
