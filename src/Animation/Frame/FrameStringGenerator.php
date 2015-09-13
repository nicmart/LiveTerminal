<?php
/**
 * This file is part of library-template
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicolo@martini.io>
 */

namespace NicMart\LiveTerminal\Animation\Frame;

/**
 * Interface FrameStringGenerator
 * @package NicMart\LiveTerminal
 */
interface FrameStringGenerator
{
    /**
     * @param string $string
     * @return mixed
     */
    public function generateFrame($string);
} 