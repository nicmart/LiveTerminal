<?php
/**
 * This file is part of library-template
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicmartnic@gmail.com>
 */

namespace NicMart\LiveTerminal\Transformer;

/**
 * Interface MultipleLinesTransformer
 * @package NicMart\LiveTerminal\Transformer
 */
interface MultipleLinesTransformer
{
    /**
     * @param array $lines
     * @return mixed
     */
    public function getLines(array $lines);
} 