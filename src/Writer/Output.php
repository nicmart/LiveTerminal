<?php
/**
 * This file is part of library-template
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicolo@martini.io>
 */

namespace NicMart\LiveTerminal\Writer;

/**
 * Interface Output
 * @package NicMart\LiveTerminal\Output
 */
interface Output
{
    /**
     * @param $string
     * @return mixed
     */
    public function write($string);
} 