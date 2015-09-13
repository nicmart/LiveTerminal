<?php
/**
 * This file is part of library-template
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicolo@martini.io>
 */

use NicMart\LiveTerminal\Animation\DefaultAnimation;
use NicMart\LiveTerminal\Animation\Frame\OverwriteFrameStringGenerator;
use NicMart\LiveTerminal\Animation\ThrottledAnimation;
use NicMart\LiveTerminal\TerminalWidthProvider\TputTerminalWidthProvider;
use NicMart\LiveTerminal\Transformer\SimpleMultipleLineTransformer;
use NicMart\LiveTerminal\Transformer\SplitLineTransformer;
use NicMart\LiveTerminal\Transformer\TruncateLineTransformer;
use NicMart\LiveTerminal\Writer\EchoOutput;
use NicMart\LiveTerminal\Writer\ThrottledWriter;

include "../vendor/autoload.php";

$writer = new EchoOutput();
$widthProvider = new TputTerminalWidthProvider;

$truncateLineTransformer = new TruncateLineTransformer($widthProvider, "\x20", "....");
$splitLineTransformer = new SplitLineTransformer($widthProvider, "\x20");

$frameGenerator = new OverwriteFrameStringGenerator(
    new SimpleMultipleLineTransformer($splitLineTransformer)
);

$animation = new ThrottledAnimation(
    new DefaultAnimation($frameGenerator, new EchoOutput()),
    1
);

$size = 150;

while (true) {
    $lineLength = rand(50, 200);
    $numberOfLines = rand(1, 10);
    $char = chr(rand(32, 126));
    $lines = array_fill(0, $numberOfLines, str_repeat($char, $lineLength));
    $animation->frame(implode("\n", $lines));
    usleep(100000);
}