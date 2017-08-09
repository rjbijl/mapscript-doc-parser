<?php

namespace Rjbijl\Parser;

/**
 * Rjbijl\Parser\ConstantsParser
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class ConstantsParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function parse(array $lines)
    {
        $constants = [];
        $section = '';
        foreach ($lines as $line) {
            if (empty(trim($line))) {
                continue;
            }
            if (strstr($line, ':')) {
                continue;
            }

            if (strstr($line, 'MS_') === false) {
                if ('    ' === substr($line, 0, 4)) {
                    $constants[$section]['comments'][] = trim($line);
                } else {
                    $section = $line;
                }
            } else {
                $parts = explode(',', $line);
                foreach ($parts as $part) {
                    if (!empty($part)) {
                        $constants[$section]['constants'][] = trim($part);
                    }
                }
            }
        }

        return $constants;
    }
}