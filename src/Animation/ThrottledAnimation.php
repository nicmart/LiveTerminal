<?php
/**
 * This file is part of library-template
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicmartnic@gmail.com>
 */

namespace NicMart\LiveTerminal\Animation;

/**
 * Class ThrottledWriter
 * @package NicMart\LiveTerminal\Output
 */
class ThrottledAnimation implements Animation
{
    /**
     * @var float
     */
    private $threshold;

    /**
     * @var float
     */
    private $lastFrameTime = 0;

    /**
     * @var Animation
     */
    private $animation;

    /**
     * @param Animation $animation
     * @param $threshold
     */
    public function __construct(Animation $animation, $threshold)
    {
        $this->threshold = $threshold;
        $this->animation = $animation;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function frame($string)
    {
        $time = microtime(true);
        if ($time - $this->lastFrameTime > $this->threshold) {
            $this->animation->frame($string);
            $this->lastFrameTime = $time;
        }
    }
}