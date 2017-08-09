<?php

namespace Rjbijl\Parser;

/**
 * Rjbijl\Parser\ParserInterface
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
interface ParserInterface
{
    /**
     * Parse an array of lines into an array of structured elements
     *
     * @param array $lines
     * @return array
     */
    public function parse(array $lines);
}