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

/**
 * Class SimpleMultipleLineTransformer
 * @package NicMart\LiveTerminal\Transformer
 */
class SimpleMultipleLineTransformer implements MultipleLinesTransformer
{
    /**
     * @var LineTransformer
     */
    private $lineTransformer;

    /**
     * @param LineTransformer $lineTransformer
     */
    public function __construct(LineTransformer $lineTransformer)
    {
        $this->lineTransformer = $lineTransformer;
    }

    /**
     * @param array $lines
     * @return mixed
     */
    public function getLines(array $lines)
    {
        $outLines = array();

        foreach ($lines as $line) {
            foreach ($this->lineTransformer->getLines($line) as $subLine) {
                $outLines[] = $subLine;
            }
        }

        return $outLines;
    }
}