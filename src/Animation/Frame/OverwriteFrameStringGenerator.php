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
    /**
     *
     */
    const HIDECURSOR = "\e[?25l";
    /**
     *
     */
    const SHOWCURSOR = "\e[?25h";

    /**
     * @var array
     */
    private $previousLines = array();
    /**
     * @var int
     */
    private $previousNumberOfTerminalLines = 0;

    /**
     * @var MultipleLinesTransformer
     */
    private $linesTransformer;

    /**
     * @var bool
     */
    private $hideCursor;

    /**
     * @param MultipleLinesTransformer $linesTransformer
     * @param bool $hideCursor
     */
    public function __construct(MultipleLinesTransformer $linesTransformer, $hideCursor = true)
    {
        $this->linesTransformer = $linesTransformer;
        $this->hideCursor = $hideCursor;
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

        return $this->wrapWithShowHideCursorSequences($result);
    }

    /**
     * @param $string
     * @return string
     */
    private function wrapWithShowHideCursorSequences($string)
    {
        if (!$this->hideCursor) {
            return $string;
        }

        return self::HIDECURSOR . $string . self::SHOWCURSOR;
    }

    /**
     * @param $n
     * @return string
     */
    private function moveUp($n)
    {
        return "\e[{$n}A";
    }

    /**
     * @param $n
     * @return string
     */
    private function moveBack($n)
    {
        return "\e[{$n}D";
    }
} 