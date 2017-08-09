<?php

namespace Rjbijl\Parser;

use Rjbijl\Model\ConstantModel;

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
        foreach ($lines as $line) {
            if (empty(trim($line))) {
                continue;
            }
            if (strstr($line, ':')) {
                continue;
            }

            if (strstr($line, 'MS_') !== false) {
                $parts = explode(',', $line);
                foreach ($parts as $part) {
                    if (!empty(trim($part))) {
                        $constants[] = trim($part);
                    }
                }
            }
        }

        $constants = array_unique($constants);

        $models = [];
        foreach ($constants as $constant) {
            $models[] = new ConstantModel($constant);
        }

        return $models;
    }
}