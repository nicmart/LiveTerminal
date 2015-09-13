<?php
/**
 * This file is part of library-template
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicmartnic@gmail.com>
 */

namespace NicMart\LiveTerminal\Writer;

/**
 * Class ThrottledWriter
 * @package NicMart\LiveTerminal\Output
 */
class ThrottledWriter implements Output
{
    /**
     * @var Output
     */
    private $writer;

    /**
     * @var float
     */
    private $threshold;

    /**
     * @var float
     */
    private $lastWriteTime = 0;

    /**
     * @param Output $writer
     * @param $threshold
     */
    public function __construct(Output $writer, $threshold)
    {
        $this->writer = $writer;
        $this->threshold = $threshold;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function write($string)
    {
        $time = microtime(true);
        if ($time - $this->lastWriteTime > $this->threshold) {
            $this->writer->write($string);
            $this->lastWriteTime = $time;
        }
    }


}