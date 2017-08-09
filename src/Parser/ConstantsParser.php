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
                    if (!empty(trim($part)) && preg_match('/([A-Z_0-9]*)\s*(.*)$/', trim($part), $matches)) {
                        if (!isset($constants[$matches[1]])) {
                            $constants[$matches[1]] = [
                                'value' => '\'\'',
                                'description' => $matches[2],
                            ];
                        }
                    }
                }
            }
        }

        $models = [];
        foreach ($constants as $name => $properties) {
            // all constants in the docs have no value :(
            $models[] = new ConstantModel($name, $properties['value'], $properties['description']);
        }

        return $models;
    }
}