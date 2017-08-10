<?php

namespace Rjbijl\Parser;

use Rjbijl\Model\ClassMemberModel;
use Rjbijl\Model\ClassMethodModel;
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
        $methods = isset($classArray['Methods']) ? $this->parseClassMethods($classArray['Methods']) : [];
        $model = new ClassModel($classArray['className'], $members, $methods);

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
        $line = reset($membersArray);
        /** @var ClassMemberModel $currentMember */
        $currentMember = null;
        do {
            if (' ' === substr($line, 0, 1) && null !== $currentMember) {
                $currentMember->addDescription(trim($line));
            } elseif (preg_match('/([a-zA-Z0-9-_]*)\s+([a-zA-Z0-9-_]*)(.*)$/', $line, $matches)) {
                if ($currentMember !== null) {
                    $members[] = $currentMember;
                }
                $description = !empty(trim($matches[3])) ? [trim($matches[3])] : [];
                $currentMember = new ClassMemberModel($matches[2], $matches[1], $description);
            }
            $line = next($membersArray);
        } while (!strstr($line, '===') && false !== $line);

        return $members;
    }

    /**
     * @param array $methodsArray
     * @return ClassMethodModel[]
     */
    private function parseClassMethods(array $methodsArray)
    {
        $methodsArray = array_splice($methodsArray, 1);
        $methods = [];
        $line = reset($methodsArray);
        if ('None' === trim($line)) {
            return $methods;
        }
        /** @var ClassMethodModel $currentMethod */
        $currentMethod = null;
        do {
            // if we have a new funtion definition
            if ($this->isSignature($line)) {
                // we flush the current one
                if (null !== $currentMethod) {
                    $methods[] = $currentMethod;
                }
                // and create a new one
                $signature = $this->parseSignature($line);
                $currentMethod = new ClassMethodModel(
                    $signature->getName(),
                    $signature->getReturnType(),
                    $signature->getArguments()
                );
            } elseif (null !== $currentMethod) {
                $currentMethod->addDescription(trim($line));
            }

            $line = next($methodsArray);
        } while ('.. index::' !== trim($line) && false !== $line);

        return $methods;
    }
}