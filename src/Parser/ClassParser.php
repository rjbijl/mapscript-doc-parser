<?php

namespace Rjbijl\Parser;

use Rjbijl\Model\ClassModel;

/**
 * Rjbijl\Parser\ClassParser
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class ClassParser implements ParserInterface
{
    use SignatureTrait;

    /**
     * {@inheritdoc}
     */
    public function parse(array $lines)
    {
        $line = reset($lines);
        $currentClass = '';
        $classes = [];

        do {
            $nextLine = next($lines);

            if (strstr($nextLine, '^^^^')) {
                $currentClass = trim($line);
                continue;
            } elseif (!empty($currentClass)) {
                $classes[$currentClass][] = $line;
            }
        } while ($line = $nextLine);

        $models = [];
        foreach ($classes as $className => $class) {
            $models[] = new ClassModel($className);
        }

        return $models;
    }
}