<?php
/**
 * @author Nicolò Martini - <nicolo.martini@dxi.eu>
 *
 * Created on 02/11/2015, 11:25 
 * Copyright (C) DXI Ltd
 */

namespace NicMart\LiveTerminal\Animation\Frame;

/**
 * Class PlainStringGenerator
 * @package NicMart\LiveTerminal\Animation\Frame
 */
class PlainStringGenerator implements FrameStringGenerator
{
    /**
     * @var array
     */
    private $stringsToRemove;

    /**
     * @param array $stringsToRemove
     */
    public function __construct($stringsToRemove = array())
    {
        $this->stringsToRemove = $stringsToRemove;
    }

    /**
     * @param string $string
     * @return mixed
     */
    public function generateFrame($string)
    {
        return str_replace($this->stringsToRemove, "", $string) . "\n";
    }
}