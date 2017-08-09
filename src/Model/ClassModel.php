<?php

namespace Rjbijl\Model;

/**
 * Rjbijl\Model\ClassModel
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class ClassModel
{
    private $className;

    /**
     * ClassModel constructor.
     * @param $className
     */
    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * Getter for className
     *
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }
}