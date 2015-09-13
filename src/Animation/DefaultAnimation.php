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

use NicMart\LiveTerminal\Animation\Frame\FrameStringGenerator;
use NicMart\LiveTerminal\Writer\Output;

/**
 * Class DefaultAnimation
 * @package NicMart\LiveTerminal\Animation
 */
class DefaultAnimation implements Animation
{
    /**
     * @var FrameStringGenerator
     */
    private $frameStringGenerator;

    /**
     * @var Output
     */
    private $output;

    /**
     * @param FrameStringGenerator $frameStringGenerator
     * @param Output $output
     */
    public function __construct(FrameStringGenerator $frameStringGenerator, Output $output)
    {
        $this->frameStringGenerator = $frameStringGenerator;
        $this->output = $output;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function frame($string)
    {
        $this->output->write($this->frameStringGenerator->generateFrame($string));
    }
}