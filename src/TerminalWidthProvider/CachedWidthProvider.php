<?php
/**
 * @author Nicolò Martini - <nicolo@martini.io>
 *
 * Created on 28/09/2015, 22:50
 */

namespace NicMart\LiveTerminal\TerminalWidthProvider;

/**
 * Class CachedWidthProvider
 * @package NicMart\LiveTerminal\TerminalWidthProvider
 */
class CachedWidthProvider implements WidthProvider
{
    /**
     * @var WidthProvider
     */
    private $widthProvider;

    /**
     * @var float
     */
    private $refreshThreshold;

    /**
     * @var float
     */
    private $time;

    /**
     * @var
     */
    private $cachedWidth;

    /**
     * @param WidthProvider $widthProvider
     * @param float|int $refreshThreshold
     */
    public function __construct(WidthProvider $widthProvider, $refreshThreshold = INF)
    {
        $this->widthProvider = $widthProvider;
        $this->refreshThreshold = $refreshThreshold;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        $time = microtime(true);

        if (!isset($this->cachedWidth)) {
            $this->cachedWidth = $this->widthProvider->getWidth();
            $this->time = $time;
        }

        return $this->cachedWidth;
    }
}