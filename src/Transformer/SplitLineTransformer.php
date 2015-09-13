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


use NicMart\LiveTerminal\TerminalWidthProvider\WidthProvider;

/**
 * Class SplitLineTransformer
 * @package NicMart\LiveTerminal\Transformer
 */
class SplitLineTransformer implements LineTransformer
{
    /**
     * @var WidthProvider
     */
    private $widthProvider;

    /**
     * @var null
     */
    private $padWith;

    /**
     * @param WidthProvider $widthProvider
     * @param null $padWith
     */
    public function __construct(WidthProvider $widthProvider, $padWith = null)
    {
        $this->widthProvider = $widthProvider;
        $this->padWith = $padWith;
    }

    /**
     * @param $line
     * @return string[]
     */
    public function getLines($line)
    {
        $width = $this->widthProvider->getWidth();
        $lines = str_split($line, $width);

        if ($this->padWith) {
            $n = count($lines);
            $lines[$n - 1] = str_pad($lines[$n - 1], $width, $this->padWith);
        }

        return $lines;
    }
}