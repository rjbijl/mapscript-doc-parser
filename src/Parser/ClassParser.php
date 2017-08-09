<?php

namespace Rjbijl\Parser;

use Rjbijl\Model\ClassMemberModel;
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
        $classes = $this->splitIntoClasses($lines);

        $models = [];
        foreach ($classes as $class) {
            $models[] = $this->parseClass($class);
        }

        return $models;
    }

    /**
     * Split the initial blob of lines into classes
     *
     * @param $lines
     * @return array
     */
    private function splitIntoClasses($lines)
    {
        $line = reset($lines);
        $currentClass = null;
        $currentSection = null;
        $classes = [];

        do {
            // we need to be able to look one line ahead
            $nextLine = next($lines);

            if (empty(trim($line))) {
                continue;
            }

            // if the next line is the class separator, this line is the class name
            if (strstr($nextLine, '^^^^')) {
                $currentClass = trim($line);
                $currentSection = null;
                $classes[$currentClass]['className'] = $currentClass;
                // and skip the next line, it's not that interesting anymore
                $nextLine = next($lines);
                continue;
                // we divide a class description into a few sections
            } elseif (in_array(trim($line), ['Constructor', 'Members', 'Methods', 'Example of usage'])) {
                $currentSection = trim($line);
                continue;
            } elseif (!empty($currentClass) && !empty($currentSection)) {
                $classes[$currentClass][$currentSection][] = $line;
            }
        } while ($line = $nextLine);
        
        return $classes;
    }

    /**
     * @param array $classArray
     * @return ClassModel
     */
    private function parseClass(array $classArray)
    {
        $members = isset($classArray['Members']) ? $this->parseClassMembers($classArray['Members']) : [];
        $model = new ClassModel($classArray['className'], $members);

        return $model;
    }

    /**
     * @param array $membersArray
     * @return ClassMemberModel[]
     */
    private function parseClassMembers($membersArray)
    {
        $membersArray = array_splice($membersArray, 4);
        $members = [];
        $currentMember = reset($membersArray);
        do {
            $currentMember = trim($currentMember);
            if (preg_match('/([a-zA-Z0-9-_]*)\s+([a-zA-Z0-9-_]*)(.*)$/', $currentMember, $matches)) {
                $members[] = new ClassMemberModel($matches[2], $matches[1], trim ($matches[3]));
            };
            $currentMember = next($membersArray);
        } while (!strstr($currentMember, '==='));

        return $members;
    }
}