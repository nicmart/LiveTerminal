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

use NicMart\LiveTerminal\Animation\Frame\FrameStringGenerator;
use NicMart\LiveTerminal\TerminalWidthProvider\WidthProvider;
use NicMart\LiveTerminal\Transformer\MultipleLinesTransformer;

/**
 * Class OverwriteFrameStringGenerator
 * @package NicMart\LiveTerminal
 */
class OverwriteFrameStringGenerator implements FrameStringGenerator
{
    private $previousLines = array();
    private $previousNumberOfTerminalLines = 0;

    /**
     * @var MultipleLinesTransformer
     */
    private $linesTransformer;

    /**
     * @param MultipleLinesTransformer $linesTransformer
     */
    public function __construct(MultipleLinesTransformer $linesTransformer)
    {
        $this->linesTransformer = $linesTransformer;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function generateFrame($string)
    {
        $linesToPrint = $this->linesTransformer->getLines(explode("\n", $string));
        $numOfTerminalLines = count($linesToPrint);

        $beforeCursorMoves = $this->moveUp($this->previousNumberOfTerminalLines) . $this->moveBack(2000);
        $afterCursorMoves = "";
        $numOfLinesDelta = $this->previousNumberOfTerminalLines - $numOfTerminalLines;

        if ($numOfLinesDelta > 0) {
            $linesToPrint = array_merge(
                $linesToPrint,
                $this->linesTransformer->getLines(array_fill(0, $numOfLinesDelta, ""))
            );
            $afterCursorMoves .= $this->moveUp($numOfLinesDelta);
            $afterCursorMoves .= $this->moveBack(2000);
        }

        $result = $beforeCursorMoves . implode("\n", $linesToPrint) . $afterCursorMoves . "\n";

        $this->previousLines = $linesToPrint;
        $this->previousNumberOfTerminalLines = $numOfTerminalLines;

        return $result;
    }

    private function moveUp($n)
    {
        return "\e[{$n}A";
    }

    private function moveBack($n)
    {
        return "\e[{$n}D";
    }
} 