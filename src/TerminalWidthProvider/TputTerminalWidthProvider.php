<?php
/**
 * This file is part of library-template
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicolo@martini.io>
 */

namespace NicMart\LiveTerminal\TerminalWidthProvider;

/**
 * Class TputTerminalWidthProvider
 * @package NicMart\LiveTerminal\WidthProvider
 */
class TputTerminalWidthProvider implements WidthProvider
{
    /**
     * @return int
     */
    public function getWidth()
    {
        return (int) shell_exec("tput cols");
    }
}