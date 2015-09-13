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
 * Class TruncateLineTransformer
 * @package NicMart\LiveTerminal\Transformer
 */
class TruncateLineTransformer implements LineTransformer
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
     * @var string
     */
    private $ellipsis;

    /**
     * @param WidthProvider $widthProvider
     * @param null $padWith
     * @param string $ellipsis
     */
    public function __construct(WidthProvider $widthProvider, $padWith = null, $ellipsis = "")
    {
        $this->widthProvider = $widthProvider;
        $this->padWith = $padWith;
        $this->ellipsis = $ellipsis;
    }

    /**
     * @param $line
     * @return string[]
     */
    public function getLines($line)
    {
        $width = $this->widthProvider->getWidth();
        if (strlen($line) > $width) {
            return array(substr($line, 0, $width - strlen($this->ellipsis)) . $this->ellipsis);
        }

        if ($this->padWith) {
            return array(str_pad($line, $width, $this->padWith));
        }

        return array($line);
    }


}