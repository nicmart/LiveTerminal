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
 * Interface LineTransformer
 *
 * Transform a line to 0 or more lines
 *
 * @package NicMart\LiveTerminal\Transformer
 */
interface LineTransformer
{
    /**
     * @param $line
     * @return string[]
     */
    public function getLines($line);
} 